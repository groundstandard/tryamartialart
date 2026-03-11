<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="bg-primary text-white py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <img src="/images/Asset 114gs.logos (1).png" alt="Ground Standard Agency" class="h-16 w-auto mx-auto mb-6">
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                The Most Impactful Newsletter for Martial Arts School Owners
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8">
                Join thousands of martial arts school owners who receive actionable insights, business strategies, and industry trends delivered to their inbox every week.
            </p>
            
            <!-- Newsletter Signup Form -->
            <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto" x-data="{ email: '' }">
                <input 
                    type="email" 
                    x-model="email"
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
            
            <p class="text-sm text-gray-400 mt-4">
                No spam. Unsubscribe anytime.
            </p>
        </div>
    </div>
</section>

<!-- Latest Posts Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-primary">Latest Articles</h2>
            <a href="<?php echo e(route('articles')); ?>" class="text-secondary hover:text-secondary-600 font-medium transition-colors">
                View All →
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <a href="<?php echo e(route('post.show', $post['slug'])); ?>" class="block">
                    <!-- Thumbnail -->
                    <div class="aspect-video bg-gray-200 overflow-hidden">
                        <img 
                            src="<?php echo e($post['image']); ?>" 
                            alt="<?php echo e($post['title']); ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            onerror="this.src='https://images.unsplash.com/photo-1555597673-b21d5c935865?w=600&h=400&fit=crop'"
                        >
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category Badge -->
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-secondary text-white mb-3">
                            <?php echo e($post['category']); ?>

                        </span>
                        
                        <!-- Title -->
                        <h3 class="text-lg font-bold text-primary mb-2 group-hover:text-secondary transition-colors line-clamp-2">
                            <?php echo e($post['title']); ?>

                        </h3>
                        
                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            <?php echo e($post['excerpt']); ?>

                        </p>
                        
                        <!-- Meta -->
                        <div class="flex items-center text-sm text-gray-500">
                            <span><?php echo e(date('M d, Y', strtotime($post['date']))); ?></span>
                            <span class="mx-2">•</span>
                            <span><?php echo e($post['author']); ?></span>
                        </div>
                    </div>
                </a>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-bold text-primary mb-10 text-center">Browse by Category</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a 
                href="<?php echo e(route('category', strtolower($category))); ?>" 
                class="p-6 bg-gray-50 rounded-xl text-center hover:bg-secondary hover:text-white transition-colors duration-200 group"
            >
                <span class="text-lg font-semibold text-primary group-hover:text-white"><?php echo e($category); ?></span>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Newsletter CTA Section -->
<section class="py-16 bg-tertiary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-primary mb-4">
                Ready to Transform Your Martial Arts School?
            </h2>
            <p class="text-primary/80 mb-8">
                Get weekly insights that help you grow your student base, increase retention, and build a thriving martial arts business.
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tryamartialart\resources\views/home.blade.php ENDPATH**/ ?>