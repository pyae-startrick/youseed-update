<?php
$percent = $course->getProgress(true);
?>

<div class="learning-page-navbar d-flex align-items-center justify-content-between px-15 px-lg-35 py-10">
    <div class="d-flex align-items-lg-center flex-column flex-lg-row flex-grow-2">

        <div class="learning-page-logo-card d-flex align-items-center justify-content-between justify-content-lg-start">
            <a class="navbar-brand mr-0" href="/">
                <?php if(!empty($generalSettings['logo'])): ?>
                    <img src="<?php echo e($generalSettings['logo']); ?>" class="img-cover" style="width: 11%!important"
                        alt="site logo">
                <?php endif; ?>
            </a>

            
            
        </div>

        
            
            
            
        
    </div>
    

    <div class="d-flex align-items-center">
        
        

        <button id="collapseBtn" type="button" class="btn-transparent ml-20">
            <i data-feather="menu" width="20" height="20" class=""></i>
        </button>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/course/learningPage/components/navbar.blade.php ENDPATH**/ ?>