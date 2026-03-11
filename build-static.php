<?php
/**
 * Static Site Generator for Netlify
 * Generates all pages as HTML files in the /dist folder
 */

$rootDir = __DIR__;
$distDir = $rootDir . '/dist';
$publicDir = $rootDir . '/public';

// Helper: create directory if it doesn't exist
function ensureDir($path) {
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

// Helper: render a page and save to dist
function renderPage($scriptPath, $outputPath, $vars = []) {
    global $distDir;

    // Set fake server vars needed by layout.php
    $_SERVER['HTTP_HOST'] = 'tryamartialart.netlify.app';
    $_SERVER['REQUEST_URI'] = '/';

    extract($vars);

    ob_start();
    include $scriptPath;
    $html = ob_get_clean();

    ensureDir(dirname($distDir . '/' . $outputPath));
    file_put_contents($distDir . '/' . $outputPath, $html);
    echo "Built: $outputPath\n";
}

// Helper: copy directory recursively
function copyDir($src, $dst) {
    ensureDir($dst);
    $items = scandir($src);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $srcPath = $src . '/' . $item;
        $dstPath = $dst . '/' . $item;
        if (is_dir($srcPath)) {
            copyDir($srcPath, $dstPath);
        } else {
            copy($srcPath, $dstPath);
        }
    }
}

// Load data
function loadPosts() {
    global $rootDir;
    $json = file_get_contents($rootDir . '/data/posts.json');
    return json_decode($json, true) ?? [];
}

function getPostBySlug($slug) {
    $posts = loadPosts();
    foreach ($posts as $post) {
        if ($post['slug'] === $slug) return $post;
    }
    return null;
}

function getPostsByCategory($category) {
    $posts = loadPosts();
    return array_values(array_filter($posts, fn($p) => strtolower($p['category']) === strtolower($category)));
}

function getCategories() {
    $posts = loadPosts();
    return array_values(array_unique(array_column($posts, 'category')));
}

function getRelatedPosts($category, $excludeId, $limit = 3) {
    $posts = loadPosts();
    $related = array_filter($posts, fn($p) => $p['category'] === $category && $p['id'] !== $excludeId);
    return array_slice(array_values($related), 0, $limit);
}

// ── Start Build ──────────────────────────────────────────────────────────────

ensureDir($distDir);
echo "Building static site...\n";

$viewsDir = $rootDir . '/resources/views-php';
$posts = loadPosts();
$categories = getCategories();

// Home page
$_SERVER['REQUEST_URI'] = '/';
renderPage("$viewsDir/home.php", 'index.html', [
    'posts' => $posts,
    'categories' => $categories,
    'metaTitle' => 'Try Martial Art - The Most Impactful Newsletter for Martial Arts School Owners',
    'metaDescription' => 'Join thousands of martial arts school owners who receive actionable insights, business strategies, and industry trends delivered to their inbox.',
]);

// Articles page
$_SERVER['REQUEST_URI'] = '/articles';
renderPage("$viewsDir/articles.php", 'articles/index.html', [
    'posts' => $posts,
    'categories' => $categories,
    'metaTitle' => 'All Articles | Try Martial Art',
    'metaDescription' => 'Browse all articles and insights for martial arts school owners.',
]);

// Subscribe page
$_SERVER['REQUEST_URI'] = '/subscribe';
renderPage("$viewsDir/subscribe.php", 'subscribe/index.html', [
    'posts' => $posts,
    'categories' => $categories,
    'metaTitle' => 'Subscribe | Try Martial Art',
    'metaDescription' => 'Subscribe to the most impactful newsletter for martial arts school owners.',
]);

// Individual post pages
foreach ($posts as $post) {
    $slug = $post['slug'];
    $_SERVER['REQUEST_URI'] = '/p/' . $slug;
    $relatedPosts = getRelatedPosts($post['category'], $post['id'], 3);
    renderPage("$viewsDir/post.php", "p/$slug/index.html", [
        'post' => $post,
        'relatedPosts' => $relatedPosts,
        'metaTitle' => $post['title'] . ' | Try Martial Art',
        'metaDescription' => $post['excerpt'],
        'posts' => $posts,
        'categories' => $categories,
    ]);
}

// Category pages
foreach ($categories as $category) {
    $slug = strtolower($category);
    $_SERVER['REQUEST_URI'] = '/category/' . $slug;
    $categoryPosts = getPostsByCategory($category);
    renderPage("$viewsDir/category.php", "category/$slug/index.html", [
        'posts' => $categoryPosts,
        'categories' => $categories,
        'category' => $category,
        'metaTitle' => "$category Articles | Try Martial Art",
        'metaDescription' => 'Browse all ' . strtolower($category) . ' articles for martial arts school owners.',
    ]);
}

// Copy static assets from public/
echo "Copying public assets...\n";
$publicItems = ['favicon.svg', 'robots.txt', 'images'];
foreach ($publicItems as $item) {
    $src = "$publicDir/$item";
    $dst = "$distDir/$item";
    if (is_dir($src)) {
        copyDir($src, $dst);
        echo "Copied dir: $item\n";
    } elseif (file_exists($src)) {
        copy($src, $dst);
        echo "Copied: $item\n";
    }
}

echo "\nBuild complete! Files in /dist\n";
