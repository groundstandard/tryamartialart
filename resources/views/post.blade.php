@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <ol class="flex items-center space-x-2 text-sm">
            <li>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-secondary transition-colors">Home</a>
            </li>
            <li class="text-gray-400">/</li>
            <li>
                <a href="{{ route('category', strtolower($post['category'])) }}" class="text-gray-500 hover:text-secondary transition-colors">{{ $post['category'] }}</a>
            </li>
            <li class="text-gray-400">/</li>
            <li class="text-primary font-medium truncate max-w-xs">{{ $post['title'] }}</li>
        </ol>
    </div>
</nav>

<!-- Article Header -->
<article class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Category Badge -->
        <a 
            href="{{ route('category', strtolower($post['category'])) }}"
            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-secondary text-white mb-4 hover:bg-secondary-600 transition-colors"
        >
            {{ $post['category'] }}
        </a>
        
        <!-- Title -->
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-6 leading-tight">
            {{ $post['title'] }}
        </h1>
        
        <!-- Meta -->
        <div class="flex items-center space-x-4 text-gray-600 mb-8">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold">
                    {{ substr($post['author'], 0, 1) }}
                </div>
                <div>
                    <p class="font-medium text-primary">{{ $post['author'] }}</p>
                    <p class="text-sm text-gray-500">{{ date('F d, Y', strtotime($post['date'])) }}</p>
                </div>
            </div>
        </div>
        
        <!-- Featured Image -->
        <div class="aspect-video bg-gray-200 rounded-xl overflow-hidden mb-10">
            <img 
                src="{{ $post['image'] }}" 
                alt="{{ $post['title'] }}"
                class="w-full h-full object-cover"
                onerror="this.src='https://images.unsplash.com/photo-1555597673-b21d5c935865?w=1200&h=675&fit=crop'"
            >
        </div>
        
        <!-- Article Content -->
        <div class="prose prose-lg max-w-none">
            {!! $post['content'] !!}
        </div>
        
        <!-- Social Share -->
        <div class="border-t border-b py-6 my-10">
            <div class="flex items-center justify-between">
                <span class="font-semibold text-primary">Share this article:</span>
                <div class="flex items-center space-x-4">
                    <a 
                        href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post['title']) }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-secondary hover:text-white transition-colors"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a 
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-secondary hover:text-white transition-colors"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                    <a 
                        href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post['title']) }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-secondary hover:text-white transition-colors"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <button 
                        onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');"
                        class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-secondary hover:text-white transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Posts -->
@if(count($relatedPosts) > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-primary mb-8">Related Articles</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPosts as $relatedPost)
            <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <a href="{{ route('post.show', $relatedPost['slug']) }}" class="block">
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        <img 
                            src="{{ $relatedPost['image'] }}" 
                            alt="{{ $relatedPost['title'] }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            onerror="this.src='https://images.unsplash.com/photo-1555597673-b21d5c935865?w=600&h=400&fit=crop'"
                        >
                    </div>
                    <div class="p-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-secondary text-white mb-3">
                            {{ $relatedPost['category'] }}
                        </span>
                        <h3 class="text-lg font-bold text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2">
                            {{ $relatedPost['title'] }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $relatedPost['excerpt'] }}
                        </p>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Newsletter CTA -->
<section class="py-16 bg-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                Enjoyed this article?
            </h2>
            <p class="text-gray-300 mb-8">
                Subscribe to get more insights like this delivered straight to your inbox every week.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input 
                    type="email" 
                    placeholder="Enter your email address" 
                    class="flex-1 px-4 py-3 rounded-lg text-primary focus:outline-none focus:ring-2 focus:ring-tertiary"
                    required
                >
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-tertiary text-primary font-semibold rounded-lg hover:bg-tertiary-400 transition-colors duration-200 whitespace-nowrap"
                >
                    Subscribe Free
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
