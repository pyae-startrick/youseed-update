<div class="content-tab p-15 pb-50">

    

    
    



    
    


    
    <?php if(!empty($course->files) and count($course->files)): ?>
        <?php if(!empty($filesWithoutChapter) and count($filesWithoutChapter)): ?>
            <?php $__currentLoopData = $filesWithoutChapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.course.learningPage.components.content_tab.content_old', [
                    'item' => $file,
                    'type' => \App\Models\WebinarChapter::$chapterFile,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($fileChapters) and count($fileChapters)): ?>
            <?php echo $__env->make('web.default.course.learningPage.components.content_tab.chapter', [
                'chapters' => $fileChapters,
                'type' => \App\Models\WebinarChapter::$chapterFile,
                'relationMethod' => 'files',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    
    <?php if(!empty($course->textLessons) and count($course->textLessons)): ?>
        <?php if(!empty($textLessonsWithoutChapter) and count($textLessonsWithoutChapter)): ?>
            <?php $__currentLoopData = $textLessonsWithoutChapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $textLesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.course.learningPage.components.content_tab.content', [
                    'item' => $textLesson,
                    'type' => \App\Models\WebinarChapter::$chapterTextLesson,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($textLessonChapters) and count($textLessonChapters)): ?>
            <?php echo $__env->make('web.default.course.learningPage.components.content_tab.chapter', [
                'chapters' => $textLessonChapters,
                'type' => \App\Models\WebinarChapter::$chapterTextLesson,
                'relationMethod' => 'textLessons',
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/course/learningPage/components/content_tab/material.blade.php ENDPATH**/ ?>