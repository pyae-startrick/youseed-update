<div class="tab-item d-flex align-items-start p-10 cursor-pointer" data-type="<?php echo e($type); ?>" data-id="<?php echo e($item->id); ?>">


        <span class="chapter-icon bg-gray300 mr-10">
            <?php
                $icon = '';
                $hintText= '';

                if ($type == \App\Models\WebinarChapter::$chapterSession) {
                    $icon = 'video';
                    $hintText = dateTimeFormat($item->date, 'j M Y  H:i') . ' | ' . $item->duration . ' ' . trans('public.min');
                } elseif ($type == \App\Models\WebinarChapter::$chapterFile) {
                    $hintText = $item->file_type . ($item->volume > 0 ? ' | '.$item->volume : '');

                    $icon = $item->getIconByType();
                } elseif ($type == \App\Models\WebinarChapter::$chapterTextLesson) {
                    $icon = 'file-text';
                    $hintText= $item->study_time . ' ' . trans('public.min');
                }
            ?>

            <i data-feather="<?php echo e($icon); ?>" class="text-gray" width="16" height="16"></i>
        </span>

    <div>
        <div class="">
            <span class="font-weight-500 font-14 text-dark-blue d-block"><?php echo e($item->title); ?></span>
            <span class="font-12 text-gray d-block"><?php echo e($hintText); ?></span>
        </div>


        <div class="tab-item-info mt-15">
            <p class="font-12 text-gray d-block">
                <?php
                    $description = !empty($item->description) ? $item->description : (!empty($item->summary) ? $item->summary : '');
                ?>

                <?php echo truncate($description, 150); ?>

            </p>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/course/learningPage/components/content_tab/content_old.blade.php ENDPATH**/ ?>