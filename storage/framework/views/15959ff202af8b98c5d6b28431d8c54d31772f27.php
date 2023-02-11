<?php $__env->startPush('libraries_top'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">
                
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Name</label>
                            <input placeholder="Enter Student Name" name="full_name" type="text" class="form-control"
                                value="<?php echo e(request()->get('full_name')); ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Student ID</label>
                            <input placeholder="Enter Student ID" name="student_id" type="number" class="form-control"
                                value="<?php echo e(request()->get('student_id')); ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Class ID</label>
                            <input placeholder="Enter Class ID" name="course_id" type="number" class="form-control"
                                value="<?php echo e(request()->get('course_id')); ?>">
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group mt-1">
                            <label class="input-label mb-4"> </label>
                            <input type="submit" class="text-center btn btn-primary w-100"
                                value="<?php echo e(trans('admin/main.show_results')); ?>">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item">Classes</div>

                <div class="breadcrumb-item">Student</div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="<?php echo e(url('/admin/webinars/studentmultidelete')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input class="btn btn-primary" type="submit" name="submit"
                                        value="Remove Selected Students from class" />
                                    <br />
                                    <br />
                                    <table id="tableList" class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left"> <input type="checkbox" id="checkAll"> Select All</th>
                                            <th><?php echo e(trans('admin/main.id')); ?></th>
                                            <th class="text-left">Student ID</th>
                                            <th class="text-left">Student Name</th>
                                            <th class="text-left">Class ID</th>
                                            <th class="text-left">Class Name</th>
                                            <th class="text-left">Created Date</th>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <th width="120"><?php echo e(trans('admin/main.actions')); ?></th>
                                        </tr>
                                        
                                        <?php if(!empty($query)): ?>
                                            
                                            <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="text-center">
                                                    <td class="text-center"><input name='id[]' type="checkbox"
                                                            id="checkItem" value="<?php echo e($sale->id); ?>">
                                                    </td>
                                                    <td><?php echo e($sale->id); ?></td>
                                                    <td class="text-left"><?php echo e($sale->buyer_id); ?></td>
                                                    <td class="text-left">
                                                        <?php echo e(isset($sale->buyer['full_name']) ? $sale->buyer['full_name'] : 'null'); ?>

                                                    </td>
                                                    <td class="text-left"><?php echo e($sale->webinar_id); ?></td>
                                                    <td class="text-left">
                                                        <?php echo e(isset($sale->webinar['slug']) ? str_replace('-', ' ', $sale->webinar['slug']) : 'null'); ?>

                                                    </td>
                                                    <td class="text-left">
                                                        <?php echo e(\Carbon\Carbon::createFromTimestamp($sale->created_at)); ?></td>


                                                    <td width="120" class="btn-sm">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_delete')): ?>
                                                            <?php echo $__env->make('admin.includes.delete_button', [
                                                                'url' =>
                                                                    '/admin/webinars/student/' .
                                                                    $sale->id .
                                                                    '/delete',
                                                                'btnClass' => 'btn-sm mt-1',
                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if($query[0] == null): ?>
                                            <tr class="text-center">
                                                <td class="text-center">No Data !</td>
                                            </tr>
                                        <?php endif; ?>

                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($query->appends(request()->input())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script language="javascript">
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/Code/lms/resources/views/admin/webinars/student.blade.php ENDPATH**/ ?>