@extends('layouts.app')

@section('content')
<!-- Subscribe Hero -->
<section class="bg-primary text-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                Join the #1 Newsletter for Martial Arts School Owners
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8">
                Get weekly insights on growing your student base, increasing retention, and building a thriving martial arts business.
            </p>
            
            <!-- Newsletter Signup Form -->
            <form class="max-w-lg mx-auto" x-data="{ email: '', submitted: false }">
                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <input 
                        type="email" 
                        x-model="email"
                        placeholder="Enter your email address" 
                        class="flex-1 px-4 py-4 rounded-lg text-primary text-lg focus:outline-none focus:ring-2 focus:ring-tertiary"
                        required
                    >
                    <button 
                        type="submit" 
                        @click.prevent="submitted = true"
                        class="px-8 py-4 bg-tertiary text-primary font-bold text-lg rounded-lg hover:bg-tertiary-400 transition-colors duration-200 whitespace-nowrap"
                    >
                        Subscribe Free
                    </button>
                </div>
                
                <p x-show="submitted" x-cloak class="text-tertiary font-medium">
                    Thanks for subscribing! Check your inbox to confirm.
                </p>
            </form>
            
            <p class="text-sm text-gray-400 mt-6">
                Join 5,000+ martial arts school owners. No spam. Unsubscribe anytime.
            </p>
        </div>
    </div>
</section>

<!-- What You'll Get -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-12 text-center">What You'll Get</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">Actionable Insights</h3>
                <p class="text-gray-600">Practical strategies you can implement immediately to grow your school.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-tertiary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">Business Growth</h3>
                <p class="text-gray-600">Learn proven methods to increase revenue and profitability.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-2">Community Access</h3>
                <p class="text-gray-600">Connect with thousands of like-minded school owners.</p>
            </div>
        </div>
    </div>
</section>

<!-- Topics We Cover -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-12 text-center">Topics We Cover</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-secondary text-white">
                    Student Retention
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-tertiary text-primary">
                    Marketing
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-primary text-white">
                    Leadership
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-secondary text-white">
                    Operations
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-tertiary text-primary">
                    Sales
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-primary text-white">
                    Team Building
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-secondary text-white">
                    Technology
                </span>
            </div>
            <div class="bg-white p-6 rounded-xl text-center shadow-sm">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-tertiary text-primary">
                    Growth Strategy
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-16 bg-tertiary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-primary mb-4">
                Ready to Transform Your School?
            </h2>
            <p class="text-primary/80 mb-8">
                Join the newsletter that's helping martial arts school owners build better businesses.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input 
                    type="email" 
                    placeholder="Enter your email address" 
                    class="flex-1 px-4 py-3 rounded-lg text-primary focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                >
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-600 transition-colors duration-200 whitespace-nowrap"
                >
                    Subscribe Now
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
