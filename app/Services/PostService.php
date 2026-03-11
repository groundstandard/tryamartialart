<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class PostService
{
    public function all(): array
    {
        return $this->loadPosts();
    }

    public function findBySlug(string $slug): ?array
    {
        foreach ($this->loadPosts() as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }
        return null;
    }

    public function getByCategory(string $category): array
    {
        return array_values(array_filter($this->loadPosts(), function ($post) use ($category) {
            return strtolower($post['category']) === strtolower($category);
        }));
    }

    public function getCategories(): array
    {
        $categories = array_unique(array_column($this->loadPosts(), 'category'));
        return array_values($categories);
    }

    public function getLatest(int $limit = 6): array
    {
        return array_slice($this->loadPosts(), 0, $limit);
    }

    public function getRelated(string $category, string $excludeSlug, int $limit = 3): array
    {
        $related = array_filter($this->loadPosts(), function ($post) use ($category, $excludeSlug) {
            return $post['category'] === $category && $post['slug'] !== $excludeSlug;
        });
        return array_slice(array_values($related), 0, $limit);
    }

    protected function loadPosts(): array
    {
        return Cache::remember('posts', 300, function () {
            $postsDir = base_path('content/posts');
            $posts = [];

            if (!is_dir($postsDir)) {
                return $posts;
            }

            foreach (glob($postsDir . '/*.json') as $file) {
                $json = file_get_contents($file);
                $post = json_decode($json, true);

                if (is_array($post) && isset($post['slug'])) {
                    $posts[] = $post;
                }
            }

            usort($posts, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            return $posts;
        });
    }
}
