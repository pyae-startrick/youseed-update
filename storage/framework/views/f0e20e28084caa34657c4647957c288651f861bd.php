<?php $__env->startPush('libraries_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1>Teacher List</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Teachers</a></div>
                <div class="breadcrumb-item"><?php echo e(trans('admin/main.users')); ?></div>
            </div>
        </div>
    </section>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(trans('admin/main.total_instructors')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($totalInstructors); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-info-circle"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(trans('admin/main.inactive_instructors')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($inactiveInstructors); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-info-circle"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4><?php echo e(trans('admin/main.inactive_instructors')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php echo e($pendingInstructors); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="card">
            <div class="card-body">
                <form method="get" class="mb-0">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label">Search By Teacher Name</label>
                                <input name="full_name" type="text" class="form-control" placeholder="Enter your teacher name" value="<?php echo e(request()->get('full_name')); ?>" list="teachername">
                                <datalist id='teachername'>
                                    <?php $__currentLoopData = $datalists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($name->full_name); ?>"" />
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('admin/main.start_date')); ?></label>
                                <div class="input-group">
                                    <input type="date" id="from" class="text-center form-control" name="from" value="<?php echo e(request()->get('from')); ?>" placeholder="Start Date">
                                </div>
                            </div>
                        </div>
                        


                        


                        

                        


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="input-label"><?php echo e(trans('admin/main.status')); ?></label>
                                <select name="status" data-plugin-selectTwo class="form-control populate">
                                    <option value="">All Status</option>
                                    <option value="active_verified" <?php if(request()->get('status') == 'active_verified'): ?> selected <?php endif; ?>>Active</option>
                                    
                                    <option value="inactive" <?php if(request()->get('status') == 'inactive'): ?> selected <?php endif; ?>>Inactive</option>
                                    
                                </select>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <label class="input-label mb-4"> </label>
                                <input type="submit" class="text-center btn btn-primary w-100" value="<?php echo e(trans('admin/main.show_results')); ?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <div class="card">
        <div class="card-header">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_export_excel')): ?>
                <a href="/admin/instructors/excel?<?php echo e(http_build_query(request()->all())); ?>" class="btn btn-primary"><?php echo e(trans('admin/main.export_xls')); ?></a>
            <?php endif; ?>
            <div class="h-10"></div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table table-striped font-14">
                    <tr>
                        <th><?php echo e(trans('admin/main.id')); ?></th>
                        <th><?php echo e(trans('admin/main.name')); ?></th>
                        <th>Classes</th>
                        
                        
                        
                        
                        
                        <th><?php echo e(trans('admin/main.register_date')); ?></th>
                        <th><?php echo e(trans('admin/main.status')); ?></th>
                        <th width="120"><?php echo e(trans('admin/main.actions')); ?></th>
                    </tr>

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td class="text-left">
                                <div class="d-flex align-items-center">
                                    <figure class="avatar mr-2">
                                        <img src="<?php echo e($user->getAvatar()); ?>" alt="<?php echo e($user->full_name); ?>">
                                    </figure>
                                    <div class="media-body ml-1">
                                        <div class="mt-0 mb-1 font-weight-bold"><?php echo e($user->full_name); ?></div>

                                        <?php if($user->mobile): ?>
                                            <div class="text-primary text-small font-600-bold"><?php echo e($user->mobile); ?></div>
                                        <?php endif; ?>

                                        <?php if($user->email): ?>
                                            <div class="text-primary text-small font-600-bold"><?php echo e($user->email); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="media-body">
                                    <div class="text-primary mt-0 mb-1 font-weight-bold"><?php echo e($user->classesSalesCount); ?></div>
                                    
                                </div>
                            </td>
                            
                            
                            

                            

                            

                            <td><?php echo e(dateTimeFormat($user->created_at, 'j M Y - H:i')); ?></td>

                            <td>
                                <div class="media-body">
                                    <?php if($user->ban and !empty($user->ban_end_at) and $user->ban_end_at > time()): ?>
                                        <div class="mt-0 mb-1 font-weight-bold text-danger"><?php echo e(trans('admin/main.banned')); ?></div>
                                        <div class="text-small font-600-bold"><?php echo e(trans('admin/main.until')); ?> <?php echo e(dateTimeFormat($user->ban_end_at, 'j M Y')); ?></div>
                                    <?php else: ?>
                                        <div class="mt-0 mb-1 font-weight-bold <?php echo e(($user->status == 'active') ? 'text-success' : 'text-warning'); ?>"><?php echo e(trans('admin/main.'.$user->status)); ?></div>
                                        
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="text-center mb-2" width="120">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_impersonate')): ?>
                                    <a href="/admin/users/<?php echo e($user->id); ?>/impersonate" target="_blank" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('admin/main.login')); ?>">
                                        <i class="fa fa-user-shield"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_edit')): ?>
                                    <a href="/admin/users/<?php echo e($user->id); ?>/edit" class="btn-transparent  text-primary" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('admin/main.edit')); ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_delete')): ?>
                                    <?php echo $__env->make('admin.includes.delete_button',['url' => '/admin/users/'.$user->id.'/delete' , 'btnClass' => ''], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>

        <div class="card-footer text-center">
            <?php echo e($users->appends(request()->input())->links()); ?>

        </div>
    </div>


    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/admin/users/instructors.blade.php ENDPATH**/ ?>