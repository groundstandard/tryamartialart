<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getLatest(6);
        $categories = $this->postService->getCategories();

        return view('home', [
            'posts' => $posts,
            'categories' => $categories,
            'metaTitle' => 'Try Martial Art - The Most Impactful Newsletter for Martial Arts School Owners',
            'metaDescription' => 'Join thousands of martial arts school owners who receive actionable insights, business strategies, and industry trends delivered to their inbox.',
        ]);
    }

    public function show(string $slug)
    {
        $post = $this->postService->findBySlug($slug);

        if (!$post) {
            abort(404);
        }

        $relatedPosts = $this->postService->getRelated($post['category'], $post['slug'], 3);

        return view('post', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'metaTitle' => $post['title'] . ' | Try Martial Art',
            'metaDescription' => $post['excerpt'],
        ]);
    }

    public function category(string $category)
    {
        $posts = $this->postService->getByCategory($category);
        $categories = $this->postService->getCategories();

        if (empty($posts)) {
            abort(404);
        }

        return view('category', [
            'posts' => $posts,
            'category' => ucfirst($category),
            'categories' => $categories,
            'metaTitle' => ucfirst($category) . ' Articles | Try Martial Art',
            'metaDescription' => 'Browse all ' . strtolower($category) . ' articles for martial arts school owners.',
        ]);
    }

    public function articles()
    {
        $posts = $this->postService->all();
        $categories = $this->postService->getCategories();

        return view('articles', [
            'posts' => $posts,
            'categories' => $categories,
            'metaTitle' => 'All Articles | Try Martial Art',
            'metaDescription' => 'Browse all articles and insights for martial arts school owners.',
        ]);
    }

    public function subscribe()
    {
        return view('subscribe', [
            'metaTitle' => 'Subscribe | Try Martial Art',
            'metaDescription' => 'Subscribe to the most impactful newsletter for martial arts school owners.',
        ]);
    }
}
