<?php

namespace App\Services;

class PostService
{
    protected array $posts = [];

    public function __construct()
    {
        $this->loadPosts();
    }

    protected function loadPosts(): void
    {
        $jsonPath = base_path('data/posts.json');
        
        if (file_exists($jsonPath)) {
            $json = file_get_contents($jsonPath);
            $this->posts = json_decode($json, true) ?? [];
        }
    }

    public function all(): array
    {
        return $this->posts;
    }

    public function find(int $id): ?array
    {
        foreach ($this->posts as $post) {
            if ($post['id'] === $id) {
                return $post;
            }
        }
        return null;
    }

    public function findBySlug(string $slug): ?array
    {
        foreach ($this->posts as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }
        return null;
    }

    public function getByCategory(string $category): array
    {
        return array_filter($this->posts, function ($post) use ($category) {
            return strtolower($post['category']) === strtolower($category);
        });
    }

    public function getCategories(): array
    {
        $categories = array_unique(array_column($this->posts, 'category'));
        return array_values($categories);
    }

    public function getLatest(int $limit = 6): array
    {
        $sorted = $this->posts;
        usort($sorted, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        return array_slice($sorted, 0, $limit);
    }

    public function getRelated(string $category, int $excludeId, int $limit = 3): array
    {
        $related = array_filter($this->posts, function ($post) use ($category, $excludeId) {
            return $post['category'] === $category && $post['id'] !== $excludeId;
        });
        return array_slice(array_values($related), 0, $limit);
    }
}
