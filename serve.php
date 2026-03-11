<?php
/**
 * Simple PHP Development Server Router
 * 
 * This file allows running the site without Composer/Laravel dependencies
 * by using a simplified routing system.
 * 
 * Usage: php -S localhost:8000 serve.php
 */

// Get the request URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

// Load the mock data
function loadPosts() {
    $posts = [];

    // Load base posts from data/posts.json
    $jsonPath = __DIR__ . '/data/posts.json';
    if (file_exists($jsonPath)) {
        $posts = json_decode(file_get_contents($jsonPath), true) ?? [];
    }

    // Load individual posts from content/posts/*.json (published via n8n)
    $contentDir = __DIR__ . '/content/posts/';
    if (is_dir($contentDir)) {
        $existingSlugs = array_column($posts, 'slug');
        $maxId = !empty($posts) ? max(array_column($posts, 'id')) : 0;

        foreach (glob($contentDir . '*.json') as $file) {
            $post = json_decode(file_get_contents($file), true);
            if ($post && isset($post['slug']) && !in_array($post['slug'], $existingSlugs)) {
                $maxId++;
                $post['id'] = $maxId;
                if (!isset($post['author'])) $post['author'] = 'Admin';
                $posts[] = $post;
                $existingSlugs[] = $post['slug'];
            }
        }
    }

    // Sort by date descending
    usort($posts, fn($a, $b) => strcmp($b['date'] ?? '', $a['date'] ?? ''));

    return $posts;
}

function getPostBySlug($slug) {
    $posts = loadPosts();
    foreach ($posts as $post) {
        if ($post['slug'] === $slug) {
            return $post;
        }
    }
    return null;
}

function getPostsByCategory($category) {
    $posts = loadPosts();
    return array_filter($posts, function($post) use ($category) {
        return strtolower($post['category']) === strtolower($category);
    });
}

function getCategories() {
    $posts = loadPosts();
    return array_values(array_unique(array_column($posts, 'category')));
}

function getRelatedPosts($category, $excludeId, $limit = 3) {
    $posts = loadPosts();
    $related = array_filter($posts, function($post) use ($category, $excludeId) {
        return $post['category'] === $category && $post['id'] !== $excludeId;
    });
    return array_slice(array_values($related), 0, $limit);
}

// Simple routing
$posts = loadPosts();
$categories = getCategories();

// Route matching
if ($uri === '/' || $uri === '') {
    $metaTitle = 'Try Martial Art - The Most Impactful Newsletter for Martial Arts School Owners';
    $metaDescription = 'Join thousands of martial arts school owners who receive actionable insights, business strategies, and industry trends delivered to their inbox.';
    include __DIR__ . '/resources/views-php/home.php';
} elseif ($uri === '/articles') {
    $metaTitle = 'All Articles | Try Martial Art';
    $metaDescription = 'Browse all articles and insights for martial arts school owners.';
    include __DIR__ . '/resources/views-php/articles.php';
} elseif ($uri === '/subscribe') {
    $metaTitle = 'Subscribe | Try Martial Art';
    $metaDescription = 'Subscribe to the most impactful newsletter for martial arts school owners.';
    include __DIR__ . '/resources/views-php/subscribe.php';
} elseif (preg_match('#^/p/([a-z0-9-]+)$#', $uri, $matches)) {
    $slug = $matches[1];
    $post = getPostBySlug($slug);
    if ($post) {
        $relatedPosts = getRelatedPosts($post['category'], $post['id'], 3);
        $metaTitle = $post['title'] . ' | Try Martial Art';
        $metaDescription = $post['excerpt'];
        include __DIR__ . '/resources/views-php/post.php';
    } else {
        http_response_code(404);
        echo '<h1>404 - Post Not Found</h1>';
    }
} elseif (preg_match('#^/category/([a-z0-9-]+)$#', $uri, $matches)) {
    $category = ucfirst($matches[1]);
    $categoryPosts = getPostsByCategory($category);
    if (!empty($categoryPosts)) {
        $posts = $categoryPosts;
        $metaTitle = $category . ' Articles | Try Martial Art';
        $metaDescription = 'Browse all ' . strtolower($category) . ' articles for martial arts school owners.';
        include __DIR__ . '/resources/views-php/category.php';
    } else {
        http_response_code(404);
        echo '<h1>404 - Category Not Found</h1>';
    }
} else {
    // Check if it's a static file in public
    $publicPath = __DIR__ . '/public' . $uri;
    if (file_exists($publicPath) && is_file($publicPath)) {
        $ext = pathinfo($publicPath, PATHINFO_EXTENSION);
        $mimeTypes = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
        ];
        if (isset($mimeTypes[$ext])) {
            header('Content-Type: ' . $mimeTypes[$ext]);
        }
        readfile($publicPath);
    } else {
        http_response_code(404);
        echo '<h1>404 - Page Not Found</h1>';
    }
}
