<?php $templates = App\Models\CertificateTemplate::all();  ?>


<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">
                
                <img src="<?php echo e($generalSettings['logo']); ?>" style="width:60%;" class="img-cover" alt="site logo">

            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">
                <?php if(!empty($generalSettings['site_name'])): ?>
                    <?php echo e(strtoupper(substr($generalSettings['site_name'], 0, 2))); ?>

                <?php endif; ?>
            </a>
        </div>

        <ul class="sidebar-menu">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_show')): ?>
                <li class="<?php echo e(request()->is('admin/') ? 'active' : ''); ?>">
                    <a href="/admin" class="nav-link">
                        <i class="fas fa-fire"></i>
                        <span><?php echo e(trans('admin/main.dashboard')); ?></span>
                    </a>
                </li>
            <?php endif; ?>

            

            <?php if($authUser->can('admin_webinars') or $authUser->can('admin_categories') or $authUser->can('admin_filters') or $authUser->can('admin_quizzes') or $authUser->can('admin_certificate') or $authUser->can('admin_reviews_lists')): ?>
                <li class="menu-header"><?php echo e(trans('site.education')); ?></li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars')): ?>
                <li
                    class="nav-item dropdown <?php echo e((request()->is('admin/webinars*') and !request()->is('admin/webinars/comments*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Classes</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_create')): ?>
                            <li class="<?php echo e(request()->is('admin/webinars/create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/webinars/create">Create Online Class</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_list')): ?>
                            

                            <li
                                class="<?php echo e((request()->is('admin/webinars') and request()->get('type') == 'webinar') ? 'active' : ''); ?>">
                                <a class="nav-link <?php if(!empty($sidebarBeeps['webinars']) and $sidebarBeeps['webinars']): ?> beep beep-sidebar <?php endif; ?>"
                                    href="/admin/webinars?type=webinar">Online Class List</a>
                            </li>

                            
                        <?php endif; ?>

                        
                        <li class="<?php echo e(request()->is('admin/webinars/student') ? 'active' : ''); ?>">
                            <a class="nav-link" href="/admin/webinars/student">Student Class List</a>
                        </li>
                        <li class="<?php echo e(request()->is('admin/webinars/records') ? 'active' : ''); ?>">
                            <a class="nav-link" href="/admin/webinars/records">Class Recording List</a>
                        </li>

                        






                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_categories')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/categories*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-th"></i>
                        <span>Subjects</span>
                    </a>
                    <ul class="dropdown-menu">
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_categories_create')): ?>
                            <li class="<?php echo e(request()->is('admin/categories/create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/categories/create">New Subject</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_categories_list')): ?>
                            <li class="<?php echo e(request()->is('admin/categories') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/categories">Subjects List</a>
                            </li>
                        <?php endif; ?>
                       
                        
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_filters')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/filters*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-filter"></i>
                        <span>Level</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_filters_create')): ?>
                            <li class="<?php echo e(request()->is('admin/filters/create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/filters/create">New Level</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_filters_list')): ?>
                            <li class="<?php echo e(request()->is('admin/filters') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/filters">Level List</a>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_quizzes')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/quizzes*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-file"></i>
                        <span><?php echo e(trans('admin/main.quizzes')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="<?php echo e(request()->is('admin/quizzes/create') ? 'active' : ''); ?>">
                            <a class="nav-link" href="/admin/quizzes/create">New Quiz</a>
                        </li>
                        <li class="<?php echo e(request()->is('admin/quizzes') ? 'active' : ''); ?>">
                            <a class="nav-link" href="/admin/quizzes">
                                Quizzes List
                            </a>
                        </li>
                        
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/certificates*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-newspaper"></i>
                        <span><?php echo e(trans('admin/main.certificates')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if(empty($templates)): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate_template_create')): ?>
                        <li class="<?php echo e(request()->is('admin/certificates/templates/new') ? 'active' : ''); ?>">
                            <a class="nav-link"
                                href="/admin/certificates/templates/new">New Certificate</a>
                        </li>
                    <?php endif; ?>
                        <?php endif; ?>
                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate_list')): ?>
                            <li class="<?php echo e(request()->is('admin/certificates') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/certificates">Student Certificates</a>
                            </li>
                        <?php endif; ?>

                        

                        
                    </ul>
                </li>
            <?php endif; ?>

            


            

            

            

            <?php if($authUser->can('admin_users') or $authUser->can('admin_roles') or $authUser->can('admin_group') or $authUser->can('admin_users_badges') or $authUser->can('admin_become_instructors_list')): ?>
                <li class="menu-header"><?php echo e(trans('panel.users')); ?></li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users')): ?>
                <li
                    class="nav-item dropdown <?php echo e((request()->is('admin/staffs') or request()->is('admin/students') or request()->is('admin/instructors') or request()->is('admin/organizations') or request()->is('admin/assigned-students') or request()->is('admin/users/create')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-users"></i>
                        <span><?php echo e(trans('admin/main.users_list')); ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_create')): ?>
                            <li class="<?php echo e(request()->is('admin/users/create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/users/create">Create Users</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staffs_list')): ?>
                            <li class="<?php echo e(request()->is('admin/staffs') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/staffs">Admin List</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_list')): ?>
                            <li class="<?php echo e(request()->is('admin/students') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/students">Student List</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_instructors_list')): ?>
                            <li class="<?php echo e(request()->is('admin/instructors') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/instructors">Teacher List</a>
                            </li>
                        <?php endif; ?>

                        <li class="<?php echo e(request()->is('admin/assigned-students') ? 'active' : ''); ?>">
                            <a class="nav-link" href="/admin/assigned-students">Teacher's Student List</a>
                        </li>

                        

                        
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_roles')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/roles*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> <span><?php echo e(trans('admin/main.roles')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_roles_list')): ?>
                            <li class="<?php echo e(request()->is('admin/roles') ? 'active' : ''); ?>">
                                <a class="nav-link active" href="/admin/roles"><?php echo e(trans('admin/main.lists')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_roles_create')): ?>
                            <li class="<?php echo e(request()->is('admin/roles/create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/roles/create"><?php echo e(trans('admin/main.new')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            

            



            

            <?php if($authUser->can('admin_supports') or $authUser->can('admin_comments') or $authUser->can('admin_reports') or $authUser->can('admin_contacts') or $authUser->can('admin_noticeboards') or $authUser->can('admin_notifications')): ?>
                <li class="menu-header"><?php echo e(trans('admin/main.crm')); ?></li>
            <?php endif; ?>

            
            

            

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_noticeboards')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/noticeboards*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-sticky-note"></i>
                        <span><?php echo e(trans('admin/main.noticeboard')); ?></span></a>
                    <ul class="dropdown-menu">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_noticeboards_send')): ?>
                            <li class="<?php echo e(request()->is('admin/noticeboards/send') ? 'active' : ''); ?>">
                                <a class="nav-link"
                                    href="/admin/noticeboards/send"><?php echo e(trans('admin/main.new_notice_title')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_noticeboards_list')): ?>
                            <li class="<?php echo e(request()->is('admin/noticeboards') ? 'active' : ''); ?>">
                                <a class="nav-link"
                                    href="/admin/noticeboards"><?php echo e(trans('admin/main.notices_list_title')); ?></a>
                            </li>
                        <?php endif; ?>

                        
                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if($authUser->can('admin_blog') or $authUser->can('admin_pages') or $authUser->can('admin_additional_pages') or $authUser->can('admin_testimonials') or $authUser->can('admin_tags') or $authUser->can('admin_regions')): ?>
                <li class="menu-header"><?php echo e(trans('admin/main.content')); ?></li>
            <?php endif; ?>

            

            

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_testimonials')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/testimonials*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-address-card"></i>
                        <span><?php echo e(trans('admin/main.testimonials')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_testimonials_create')): ?>
                            <li class="<?php echo e(request()->is('admin/testimonials/create') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/testimonials/create">New Testimonial</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_testimonials_list')): ?>
                            <li class="<?php echo e(request()->is('admin/testimonials') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/testimonials">Testimonial List</a>
                            </li>
                        <?php endif; ?>

                        
                    </ul>
                </li>
            <?php endif; ?>

            

            

            

            

            

            

            

            

            
            

            <?php if($authUser->can('admin_discount_codes') or $authUser->can('admin_product_discount') or $authUser->can('admin_feature_webinars') or $authUser->can('admin_promotion') or $authUser->can('admin_advertising') or $authUser->can('admin_newsletters')): ?>
                <li class="menu-header">Newsletter</li>
            <?php endif; ?>
            

            

            
            

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_newsletters')): ?>
                <li class="nav-item dropdown <?php echo e(request()->is('admin/newsletters*') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-newspaper"></i>
                        <span>Newsletter</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_newsletters_lists')): ?>
                            <li class="<?php echo e(request()->is('admin/newsletters') ? 'active' : ''); ?>">
                                <a class="nav-link" href="/admin/newsletters">Newsletter List</a>
                            </li>
                        <?php endif; ?>

                        

                        
                    </ul>
                </li>
            <?php endif; ?>

            

            

            


            <li>
                <a class="nav-link" href="/admin/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
        <br><br><br>
    </aside>
</div>
<?php /**PATH /Users/admin/Code/lms/resources/views/admin/includes/sidebar.blade.php ENDPATH**/ ?>