<?php $__env->startSection('body'); ?>
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        <h1 class="h1"><?php echo e($contact->subject); ?></h1>
        <p><?php echo e(trans('admin/main.user_name')); ?> : <?php echo e($contact->name); ?></p>
        <p><?php echo nl2br($contact->reply); ?></p>

        <p><?php echo e(trans('notification.email_ignore_msg')); ?></p>
    </td>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.default.layouts.email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/emails/contact.blade.php ENDPATH**/ ?>