<div class="content-tab p-15 pb-50">

    

    
    



    
    
<?php if(!empty($sessionChapters) and count($sessionChapters)): ?>
    <?php echo $__env->make('web.default.course.learningPage.components.content_tab.chapter', [
        'chapters' => $sessionChapters,
        'type' => \App\Models\WebinarChapter::$chapterSession,
        'relationMethod' => 'sessions',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

    
    

    
    

    
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/course/learningPage/components/content_tab/index.blade.php ENDPATH**/ ?>