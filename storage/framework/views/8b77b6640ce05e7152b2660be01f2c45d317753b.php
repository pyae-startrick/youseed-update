<?php $__env->startPush('libraries_top'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search By Student Name</label>
                            <input name="full_name" type="text" class="form-control" placeholder="Enter your student name" value="<?php echo e(request()->get('full_name')); ?>" list="studentname">
                            <datalist id='studentname'>
                                <?php $__currentLoopData = $datalists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($name->full_name); ?>" />
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </datalist>
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
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item">Users</div>

                <div class="breadcrumb-item">Teacher's Student List </div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="<?php echo e(url('/admin/assigned-students/studentmultiassigndelete')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input class="btn btn-primary" type="submit" name="submit"
                                        value="Remove Selected Assigned Students from Teacher" />
                                    <br />
                                    <br />
                                    <table id="tableList" class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left"> <input type="checkbox" name="deletecheck" id="checkAll"> Select All</th>
                                            <th><?php echo e(trans('admin/main.id')); ?></th>
                                            <th class="text-left">Student Name</th>
                                            <th class="text-left">Teacher Name</th>
                                            <th class="text-left">Created Date</th>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <th width="120"><?php echo e(trans('admin/main.actions')); ?></th>
                                        </tr>
                                        
                                        <?php if(!empty($assignStudents)): ?>
                                            
                                            <?php $__currentLoopData = $assignStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="text-center">
                                                    <td class="text-center"><input name='id[]' type="checkbox"
                                                            id="checkItem" value="<?php echo e($student->id); ?>">
                                                    </td>
                                                    <td><?php echo e($student->id); ?></td>
                                                    <td class="text-left"><?php echo e($student->student_name); ?></td>
                                                    <td class="text-left"><?php echo e($student->teacher_name); ?></td>
                                                    <td class="text-left">
                                                        <?php echo e(\Carbon\Carbon::createFromTimestamp($student->created_at)); ?></td>


                                                    <td width="120" class="btn-sm">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_delete')): ?>
                                                            <?php echo $__env->make('admin.includes.delete_button', [
                                                                'url' =>
                                                                    '/admin/assigned-students/' .
                                                                    $student->id .
                                                                    '/delete',
                                                                'btnClass' => 'btn-sm mt-1',
                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if($assignStudents == null): ?>
                                            <tr class="text-center">
                                                <td class="text-center">No Data !</td>
                                            </tr>
                                        <?php endif; ?>

                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($assignStudents->appends(request()->input())->links()); ?>

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/admin/users/assigned_students.blade.php ENDPATH**/ ?>