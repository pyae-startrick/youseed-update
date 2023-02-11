<?php $__env->startPush('libraries_top'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e($pageTitle); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item">Classes</div>

                <div class="breadcrumb-item">Online Class</div>
            </div>
        </div>

        <div class="section-body">

            

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <input type="hidden" name="type" value="<?php echo e(request()->get('type')); ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Search by Class Title</label>
                                    <input name="title" type="text" class="form-control"
                                        value="<?php echo e(request()->get('title')); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Search by Class ID</label>
                                    <input name="class_id" type="text" class="form-control"
                                        value="<?php echo e(request()->get('class_id')); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(trans('admin/main.start_date')); ?></label>
                                    <div class="input-group">
                                        <input type="date" id="from" class="text-center form-control" name="from"
                                            value="<?php echo e(request()->get('from')); ?>" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(trans('admin/main.end_date')); ?></label>
                                    <div class="input-group">
                                        <input type="date" id="to" class="text-center form-control" name="to"
                                            value="<?php echo e(request()->get('to')); ?>" placeholder="End Date">
                                    </div>
                                </div>
                            </div>


                            


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Teacher</label>
                                    <select name="teacher_ids[]" multiple="multiple" data-search-option="just_teacher_role"
                                        class="form-control search-user-select2" data-placeholder="Search teachers">

                                        <?php if(!empty($teachers) and $teachers->count() > 0): ?>
                                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($teacher->id); ?>" selected><?php echo e($teacher->full_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Subject</label>
                                    <select name="category_id" data-plugin-selectTwo class="form-control populate">
                                        <option value="">All Subject</option>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                <optgroup label="<?php echo e($category->title); ?>">
                                                    <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($subCategory->id); ?>"
                                                            <?php if(request()->get('category_id') == $subCategory->id): ?> selected="selected" <?php endif; ?>>
                                                            <?php echo e($subCategory->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </optgroup>
                                            <?php else: ?>
                                                <option value="<?php echo e($category->id); ?>"
                                                    <?php if(request()->get('category_id') == $category->id): ?> selected="selected" <?php endif; ?>>
                                                    <?php echo e($category->title); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label"><?php echo e(trans('admin/main.status')); ?></label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">All Status</option>
                                        
                                        <?php if($classesType == 'webinar'): ?>
                                            
                                            <option value="active" <?php if(request()->get('status') == 'active'): ?> selected <?php endif; ?>>
                                                Published</option>
                                            <option value="pending" <?php if(request()->get('status') == 'pending'): ?> selected <?php endif; ?>>
                                                Waiting</option>
                                        <?php else: ?>
                                            <option value="active" <?php if(request()->get('status') == 'active'): ?> selected <?php endif; ?>>
                                                <?php echo e(trans('admin/main.published')); ?></option>
                                        <?php endif; ?>
                                        
                                        
                                    </select>
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

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="<?php echo e(url('/admin/webinars/classmultidelete')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input class="btn btn-primary" type="submit" name="submit"
                                        value="Delete Selected Class" />
                                    <br />
                                    <br />
                                    <table class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left"> <input type="checkbox" id="checkAll"> Select All</th>
                                            <th><?php echo e(trans('admin/main.id')); ?></th>
                                            <th class="text-left"><?php echo e(trans('admin/main.title')); ?></th>
                                            <th class="text-left">Subject</th>
                                            <th class="text-left">Level</th>
                                            <th class="text-left">Stage</th>
                                            <th class="text-left">Module</th>
                                            <th class="text-left">Teacher</th>
                                            
                                            <th><?php echo e(trans('admin/main.created_at')); ?></th>
                                            <?php if($classesType == 'webinar'): ?>
                                                <th><?php echo e(trans('admin/main.start_date')); ?></th>
                                            <?php else: ?>
                                                <th><?php echo e(trans('admin/main.updated_at')); ?></th>
                                            <?php endif; ?>
                                            <th><?php echo e(trans('admin/main.status')); ?></th>
                                            <th width="120"><?php echo e(trans('admin/main.actions')); ?></th>
                                        </tr>
                                        
                                        
                                        <?php if($webinars[0] == null): ?>
                                        <tr style="position: absolute;">
                                            <td class="">

                                                No Class Created.
                                            </td>
                                        </tr>
                                            

                                        <?php else: ?>
                                            <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                

                                                
                                                <tr class="text-center">
                                                    <td class="text-center"><input name='id[]' type="checkbox"
                                                            id="checkItem" value="<?php echo e($webinar->id); ?>">
                                                    </td>
                                                    <td><?php echo e($webinar->id); ?></td>
                                                    <td width="18%" class="text-left">
                                                        <a class="text-primary mt-0 mb-1 font-weight-bold"
                                                            href="<?php echo e($webinar->getLearningPageUrl()); ?>"
                                                            target="_blank"><?php echo e($webinar->title); ?></a>
                                                    </td>

                                                    <td class="text-left">
                                                        <?php if(!empty($webinar->category->title)): ?>
                                                            <div class="text-small"><?php echo e($webinar->category->title); ?></div>
                                                        <?php else: ?>
                                                            <div class="text-small text-warning">
                                                                No Subject</div>
                                                        <?php endif; ?>
                                                    </td>
                                                    
                                                    
                                                    <td class="text-left">
                                                        <?php $__currentLoopData = $webinar->filterOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $webinar->category->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php $__currentLoopData = $filter->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(!empty($option->title)): ?>
                                                                        <?php if($option->id == $item->filter_option_id): ?>
                                                                            <?php if($filter->title == 'Level'): ?>
                                                                                <?php echo e($option->title); ?>,
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <div class="text-small text-warning">

                                                                            No Module Selected
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>

                                                    <td class="text-left">
                                                        <?php $__currentLoopData = $webinar->filterOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $webinar->category->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php $__currentLoopData = $filter->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(!empty($option->title)): ?>
                                                                        <?php if($option->id == $item->filter_option_id): ?>
                                                                            <?php if($filter->title == 'Stage'): ?>
                                                                                <?php echo e($option->title); ?>,
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <div class="text-small text-warning">

                                                                            No Stage Selected
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>

                                                    <td class="text-left">
                                                        <?php $__currentLoopData = $webinar->filterOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $webinar->category->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php $__currentLoopData = $filter->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(!empty($option->title)): ?>
                                                                        <?php if($option->id == $item->filter_option_id): ?>
                                                                            <?php if($filter->title == 'Module Level'): ?>
                                                                                <?php echo e($option->title); ?>,
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <div class="text-small text-warning">

                                                                            No Module Selected
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </td>

                                                    <td class="text-left"><?php echo e($webinar->teacher->full_name); ?></td>


                                                    

                                                    <td class="font-12">
                                                        <?php echo e(dateTimeFormat($webinar->created_at, 'Y M j | H:i')); ?></td>

                                                    <?php if($classesType == 'webinar'): ?>
                                                        <td class="font-12">
                                                            <?php echo e(dateTimeFormat($webinar->start_date, 'Y M j | H:i')); ?></td>
                                                    <?php else: ?>
                                                        <td class="font-12">
                                                            <?php echo e(dateTimeFormat($webinar->updated_at, 'Y M j | H:i')); ?></td>
                                                    <?php endif; ?>

                                                    <td>
                                                        <?php switch($webinar->status):
                                                            case (\App\Models\Webinar::$active): ?>
                                                                <div class="text-success font-600-bold">
                                                                    <?php echo e(trans('admin/main.published')); ?></div>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                            <?php break; ?>

                                                            <?php case (\App\Models\Webinar::$isDraft): ?>
                                                                <span class="text-dark"><?php echo e(trans('admin/main.is_draft')); ?></span>
                                                            <?php break; ?>

                                                            <?php case (\App\Models\Webinar::$pending): ?>
                                                                <span
                                                                    class="text-warning"><?php echo e(trans('admin/main.waiting')); ?></span>
                                                                
                                                            <?php break; ?>
                                                        <?php endswitch; ?>
                                                    </td>
                                                    <td width="90" class="btn-sm">
                                                        

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_edit')): ?>
                                                            <a href="/admin/webinars/<?php echo e($webinar->id); ?>/edit"
                                                                target="_blank"
                                                                class="btn-transparent btn-sm text-primary mt-1"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="<?php echo e(trans('admin/main.edit')); ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_delete')): ?>
                                                            <?php echo $__env->make('admin.includes.delete_button', [
                                                                'url' =>
                                                                    '/admin/webinars/' . $webinar->id . '/delete',
                                                                'btnClass' => 'btn-sm mt-1',
                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <?php echo e($webinars->appends(request()->input())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        (function($) {
            "use strict";

            <?php if(session()->has('sweetalert')): ?>
                Swal.fire({
                    icon: "<?php echo e(session()->get('sweetalert')['status'] ?? 'success'); ?>",
                    html: '<h3 class="font-20 text-center text-dark-blue py-25"><?php echo e(session()->get('sweetalert')['msg'] ?? ''); ?></h3>',
                    showConfirmButton: true,
                    width: '25rem',
                });
            <?php endif; ?>
        })(jQuery)
    </script>
    <script language="javascript">
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/Code/lms/resources/views/admin/webinars/lists.blade.php ENDPATH**/ ?>