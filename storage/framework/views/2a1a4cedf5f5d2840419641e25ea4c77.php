<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="bg-primary text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-4"><?php echo e($category); ?></h1>
        <p class="text-gray-300 text-lg">Browse all articles in the <?php echo e($category); ?> category.</p>
    </div>
</section>

<!-- Category Filter -->
<section class="bg-white border-b sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-wrap gap-2">
            <a 
                href="<?php echo e(route('articles')); ?>" 
                class="px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-primary hover:bg-secondary hover:text-white transition-colors"
            >
                All
            </a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a 
                href="<?php echo e(route('category', strtolower($cat))); ?>" 
                class="px-4 py-2 rounded-full text-sm font-medium <?php echo e(strtolower($cat) === strtolower($category) ? 'bg-primary text-white' : 'bg-gray-100 text-primary hover:bg-secondary hover:text-white'); ?> transition-colors"
            >
                <?php echo e($cat); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-tertiary text-primary mb-3">
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
        
        <?php if(count($posts) === 0): ?>
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No articles found in this category.</p>
            <a href="<?php echo e(route('articles')); ?>" class="inline-block mt-4 text-secondary hover:text-secondary-600 font-medium">
                ← Back to all articles
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="py-16 bg-tertiary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-primary mb-4">
                Want More <?php echo e($category); ?> Insights?
            </h2>
            <p class="text-primary/80 mb-8">
                Subscribe to get the latest <?php echo e(strtolower($category)); ?> articles delivered straight to your inbox.
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tryamartialart\resources\views/category.blade.php ENDPATH**/ ?>