<?php $__env->startSection('body'); ?>
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        
        <p>Name : <?php echo e($contact['name']); ?></p>
        <p>Age: <?php echo e($contact['age']); ?></p>
        <p>Whatsapp: <?php echo e($contact['whatsapp']); ?></p>
    </td>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('web.default.layouts.email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/emails/contactForm.blade.php ENDPATH**/ ?>