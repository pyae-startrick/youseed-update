
<div class="tab-item d-flex align-items-start p-10 " data-type="<?php echo e(\App\Models\WebinarChapter::$chapterSession); ?>" data-id="<?php echo e($course->sessions[0]->id); ?>">
    
    

    <div>
        <?php if(!$get_meetings == []): ?>

            <?php $__currentLoopData = $get_meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($meeting->state != 'deleted'): ?>
                    <div class="">
                        <span class="font-weight-500 font-14 text-dark-blue d-block"><?php echo e($meeting->metadata->meetingName); ?></span>
                        <span class="font-12 text-gray d-block">
                            <a href="<?php echo e($meeting->playback->format->url); ?>"
                                target="_blank" rel="noopener noreferrer">
                                Click here to view record
                            </a>
                        </span>
                        <span class="font-12 text-black d-block">
                            <?php 
                                $mil = $meeting->startTime;
                                $seconds = $mil / 1000;
                               echo date('d/m/Y', $seconds);
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            No Class Recording available.
        <?php endif; ?>
        
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/course/learningPage/components/content_tab/record.blade.php ENDPATH**/ ?>