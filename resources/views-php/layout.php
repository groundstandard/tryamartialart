<?php
function renderLayout($content, $metaTitle = 'Try Martial Art', $metaDescription = 'The most impactful newsletter for martial arts school owners.', $post = null) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?= htmlspecialchars($metaTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <?php if ($post): ?><meta name="author" content="<?= htmlspecialchars($post['author'] ?? 'Try Martial Art') ?>"><?php endif; ?>
    <link rel="canonical" href="<?= 'https://tryamartialart.com' . $_SERVER['REQUEST_URI'] ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($metaTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription) ?>">
    <meta property="og:type" content="<?= $post ? 'article' : 'website' ?>">
    <meta property="og:url" content="<?= 'https://tryamartialart.com' . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:site_name" content="Try Martial Art">
    <?php if ($post && isset($post['image'])): ?>
    <meta property="og:image" content="<?= strpos($post['image'], 'http') === 0 ? htmlspecialchars($post['image']) : 'https://tryamartialart.com' . htmlspecialchars($post['image']) ?>">
    <?php else: ?>
    <meta property="og:image" content="https://tryamartialart.com/images/hero.jpg">
    <?php endif; ?>
    <?php if ($post): ?>
    <meta property="article:published_time" content="<?= htmlspecialchars($post['date'] ?? '') ?>">
    <meta property="article:author" content="<?= htmlspecialchars($post['author'] ?? 'Try Martial Art') ?>">
    <meta property="article:section" content="<?= htmlspecialchars($post['category'] ?? '') ?>">
    <?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@tryamartialart">
    <meta name="twitter:title" content="<?= htmlspecialchars($metaTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription) ?>">
    <?php if ($post && isset($post['image'])): ?>
    <meta name="twitter:image" content="<?= strpos($post['image'], 'http') === 0 ? htmlspecialchars($post['image']) : 'https://tryamartialart.com' . htmlspecialchars($post['image']) ?>">
    <?php endif; ?>

    <?php if ($post): ?>
    <!-- JSON-LD Article Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": <?= json_encode($post['title'] ?? '') ?>,
        "description": <?= json_encode($post['excerpt'] ?? $metaDescription) ?>,
        "datePublished": <?= json_encode($post['date'] ?? '') ?>,
        "dateModified": <?= json_encode($post['date'] ?? '') ?>,
        "author": {
            "@type": "Person",
            "name": <?= json_encode($post['author'] ?? 'Try Martial Art') ?>
        },
        "publisher": {
            "@type": "Organization",
            "name": "Try Martial Art",
            "url": "https://tryamartialart.com"
        },
        "image": <?= json_encode(strpos($post['image'] ?? '', 'http') === 0 ? $post['image'] : 'https://tryamartialart.com' . ($post['image'] ?? '')) ?>,
        "url": <?= json_encode('https://tryamartialart.com/p/' . ($post['slug'] ?? '')) ?>,
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": <?= json_encode('https://tryamartialart.com/p/' . ($post['slug'] ?? '')) ?>
        },
        "articleSection": <?= json_encode($post['category'] ?? '') ?>
    }
    </script>
    <!-- JSON-LD BreadcrumbList -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://tryamartialart.com"},
            {"@type": "ListItem", "position": 2, "name": <?= json_encode($post['category'] ?? 'Articles') ?>, "item": <?= json_encode('https://tryamartialart.com/category/' . strtolower($post['category'] ?? '')) ?>},
            {"@type": "ListItem", "position": 3, "name": <?= json_encode($post['title'] ?? '') ?>, "item": <?= json_encode('https://tryamartialart.com/p/' . ($post['slug'] ?? '')) ?>}
        ]
    }
    </script>
    <?php endif; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#120D42',
                            50: '#E8E7F0',
                            100: '#D1CFE1',
                            200: '#A39FC3',
                            300: '#756FA5',
                            400: '#473F87',
                            500: '#120D42',
                            600: '#0F0B38',
                            700: '#0C092E',
                            800: '#090724',
                            900: '#06051A',
                        },
                        secondary: {
                            DEFAULT: '#165AE7',
                            50: '#E8F0FD',
                            100: '#D1E1FB',
                            200: '#A3C3F7',
                            300: '#75A5F3',
                            400: '#4787EF',
                            500: '#165AE7',
                            600: '#1248B9',
                            700: '#0E368B',
                            800: '#0A245D',
                            900: '#06122F',
                        },
                        tertiary: {
                            DEFAULT: '#FAB301',
                            50: '#FEF5E0',
                            100: '#FDEBC1',
                            200: '#FBD783',
                            300: '#F9C345',
                            400: '#FCBB09',
                            500: '#FAB301',
                            600: '#C88F01',
                            700: '#966B01',
                            800: '#644700',
                            900: '#322400',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-primary">Try Martial Art</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-primary hover:text-secondary font-medium transition-colors">Home</a>
                    <a href="/articles" class="text-primary hover:text-secondary font-medium transition-colors">Articles</a>
                    <a href="/subscribe" class="text-primary hover:text-secondary font-medium transition-colors">Subscribe</a>
                    <a href="#" class="text-primary hover:text-secondary font-medium transition-colors">Login</a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg text-primary hover:bg-gray-100">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-cloak x-transition class="md:hidden py-4 border-t">
                <div class="flex flex-col space-y-4">
                    <a href="/" class="text-primary hover:text-secondary font-medium transition-colors">Home</a>
                    <a href="/articles" class="text-primary hover:text-secondary font-medium transition-colors">Articles</a>
                    <a href="/subscribe" class="text-primary hover:text-secondary font-medium transition-colors">Subscribe</a>
                    <a href="#" class="text-primary hover:text-secondary font-medium transition-colors">Login</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        <?= $content ?>
    </main>
    
    <!-- Footer -->
    <footer class="bg-primary text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold mb-4">Try Martial Art</h3>
                    <p class="text-gray-300 mb-4">The most impactful newsletter for martial arts school owners. Get actionable insights delivered to your inbox.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-tertiary transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-tertiary transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-tertiary transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-tertiary transition-colors">Home</a></li>
                        <li><a href="/articles" class="text-gray-300 hover:text-tertiary transition-colors">Articles</a></li>
                        <li><a href="/subscribe" class="text-gray-300 hover:text-tertiary transition-colors">Subscribe</a></li>
                    </ul>
                </div>
                
                <!-- Categories -->
                <div>
                    <h4 class="font-semibold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="/category/business" class="text-gray-300 hover:text-tertiary transition-colors">Business</a></li>
                        <li><a href="/category/marketing" class="text-gray-300 hover:text-tertiary transition-colors">Marketing</a></li>
                        <li><a href="/category/training" class="text-gray-300 hover:text-tertiary transition-colors">Training</a></li>
                        <li><a href="/category/leadership" class="text-gray-300 hover:text-tertiary transition-colors">Leadership</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> Try Martial Art. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php
}
?>
