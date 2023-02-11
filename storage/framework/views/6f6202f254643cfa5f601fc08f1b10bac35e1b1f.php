<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.css">
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
    <style>
        .bootstrap-timepicker-widget table td input {
            width: 35px !important;
        }

        .select2-container {
            z-index: 1212 !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(!empty($webinar) ? $pageTitle : $pageTitle); ?>

            </h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/"><?php echo e(trans('admin/main.dashboard')); ?></a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="/admin/webinars">Classes</a>
                </div>
                <div class="breadcrumb-item"><?php echo e(!empty($webinar) ? 'Edit Online Class' : 'New Online Class'); ?>

                </div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">

                            <form method="post"
                                action="/admin/webinars/<?php echo e(!empty($webinar) ? $webinar->id . '/update' : 'store'); ?>"
                                id="webinarForm" class="webinar-form">
                                <?php echo e(csrf_field()); ?>

                                <section>
                                    <h2 class="section-title after-line"><?php echo e(trans('public.basic_information')); ?></h2>

                                    <div class="row">
                                        <div class="col-12 col-md-5">

                                            

                                            <div class="form-group mt-15 ">
                                                <label class="input-label d-none"><?php echo e(trans('panel.course_type')); ?></label>

                                                <select name="type"
                                                    class="custom-select <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" hidden>
                                                    <option value="webinar" selected><?php echo e(trans('webinars.webinar')); ?>

                                                    </option>
                                                    
                                                </select>

                                                <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            <div class="form-group mt-15">
                                                <label class="input-label"><?php echo e(trans('public.title')); ?></label>
                                                <input type="text" name="title"
                                                    value="<?php echo e(!empty($webinar) ? $webinar->title : old('title')); ?>"
                                                    class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="" />
                                                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                            

                                            

                                            <?php if(!empty($webinar) and $webinar->creator->isOrganization()): ?>
                                                <div class="form-group mt-15 ">
                                                    <label
                                                        class="input-label d-block"><?php echo e(trans('admin/main.organization')); ?></label>

                                                    <select class="form-control" disabled readonly
                                                        data-placeholder="<?php echo e(trans('public.search_instructor')); ?>">
                                                        <option selected><?php echo e($webinar->creator->full_name); ?></option>
                                                    </select>
                                                </div>
                                            <?php endif; ?>

                                            

                                            <div
                                                class="form-group mt-15 <?php if(empty($webinar)): ?> d-block <?php else: ?> d-none <?php endif; ?> ">
                                                <label class="input-label d-block">Select an Teacher</label>

                                                <select name="teacher_id"
                                                    class="form-control select2 <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    data-placeholder="Select an Teacher">
                                                    <option <?php echo e(!empty($webinar) ? '' : 'selected'); ?> disabled>
                                                        Select an Teacher</option>

                                                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(old('teacher_id')): ?>
                                                            <option value="<?php echo e(old('teacher_id')); ?>"
                                                                <?php echo e($teacher->id == old('teacher_id') ? 'selected' : ''); ?>>
                                                                <?php echo e($teacher->full_name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($teacher->id); ?>"
                                                                <?php if(!empty($webinar) and $webinar->teacher_id == $teacher->id): ?> selected <?php endif; ?>>
                                                                <?php echo e($teacher->full_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            

                                            
                                            
                                            <div class="form-group mt-15 ">
                                                <label class="input-label d-block">Select an Students (<span style="color: gray;">To remove selected student need to go <a href="/admin/webinars/student" target="_blank">Student Class List</a> Page </span>)</label>
                                                <select multiple name="student[]"
                                                    class="form-control select2 <?php $__errorArgs = ['student'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    data-placeholder="Search an student">
                                                    
                                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(old('student')): ?>
                                                            <option value="<?php echo e($student->id); ?>"
                                                                <?php echo e(in_array($student->id, old('student')) ?? [] ? 'selected' : ''); ?>>
                                                                [<?php echo e($student->id); ?>] <?php echo e($student->full_name); ?> </option>
                                                        <?php else: ?>
                                                            <?php if(!empty($webinar)): ?>
                                                                <option value="<?php echo e($student->id); ?>" <?php foreach ($sales as $sale) {
                                                                    if ($student->id == $sale->buyer_id) {
                                                                        echo 'selected';
                                                                    }
                                                                } ?>>
                                                                    [<?php echo e($student->id); ?>] <?php echo e($student->full_name); ?>

                                                                </option>
                                                            <?php else: ?>
                                                                <option value="<?php echo e($student->id); ?>">
                                                                    [<?php echo e($student->id); ?>] <?php echo e($student->full_name); ?>

                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php $__errorArgs = ['student'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            




                                            

                                            <div class="form-group mt-15">
                                                <label class="input-label"><?php echo e(trans('public.thumbnail_image')); ?></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button type="button" class="input-group-text admin-file-manager"
                                                            data-input="thumbnail" data-preview="holder">
                                                            <i class="fa fa-upload"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" name="thumbnail" id="thumbnail"
                                                        value="<?php echo e(!empty($webinar) ? $webinar->thumbnail : old('thumbnail')); ?>"
                                                        class="form-control <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                                                    <div class="input-group-append">
                                                        <button type="button" class="input-group-text admin-file-view"
                                                            data-input="thumbnail">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    <?php $__errorArgs = ['thumbnail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>


                                            

                                            

                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mt-15">
                                                <label class="input-label"><?php echo e(trans('public.description')); ?></label>
                                                <textarea name="description" rows="5" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    placeholder="Maximum 300 words."><?php echo !empty($webinar) ? $webinar->description : old('description'); ?></textarea>
                                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section class="mt-3">
                                    <h2 class="section-title after-line"><?php echo e(trans('public.additional_information')); ?>

                                    </h2>
                                    <div class="row">
                                        <div class="col-12 col-md-6">

                                            <?php if(empty($webinar) or !empty($webinar) and $webinar->isWebinar()): ?>
                                                <div
                                                    class="form-group mt-15 js-capacity <?php echo e((!empty(old('type')) and old('type') != \App\Models\Webinar::$webinar) ? 'd-none' : ''); ?>">
                                                    <label class="input-label"><?php echo e(trans('public.capacity')); ?></label>
                                                    <input type="number" name="capacity"
                                                        value="<?php echo e(!empty($webinar) ? $webinar->capacity : old('capacity')); ?>"
                                                        class="form-control <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                                                    <?php $__errorArgs = ['capacity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="row mt-15">
                                                <?php if(empty($webinar) or !empty($webinar) and $webinar->isWebinar()): ?>
                                                    <div
                                                        class="col-12 col-md-6 js-start_date <?php echo e((!empty(old('type')) and old('type') != \App\Models\Webinar::$webinar) ? 'd-none' : ''); ?>">
                                                        <div class="form-group">
                                                            <label
                                                                class="input-label"><?php echo e(trans('public.start_date')); ?></label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"
                                                                        id="dateInputGroupPrepend">
                                                                        <i class="fa fa-calendar-alt "></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" name="start_date"
                                                                    value="<?php echo e((!empty($webinar) and $webinar->start_date) ? dateTimeFormat($webinar->start_date, 'Y-m-d H:i', false, false, $webinar->timezone) : old('start_date')); ?>"
                                                                    class="form-control <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> datetimepicker"
                                                                    aria-describedby="dateInputGroupPrepend" />
                                                                <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <div class="invalid-feedback">
                                                                        <?php echo e($message); ?>

                                                                    </div>
                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                
                                            </div>

                                            

                                            <?php if(!empty($webinar) and $webinar->creator->isOrganization()): ?>
                                                <div
                                                    class="form-group mt-30 d-flex align-items-center justify-content-between">
                                                    <label class=""
                                                        for="privateSwitch"><?php echo e(trans('webinars.private')); ?></label>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="private"
                                                            class="custom-control-input" id="privateSwitch"
                                                            <?php echo e((!empty($webinar) and $webinar->private) ? 'checked' : ''); ?>>
                                                        <label class="custom-control-label" for="privateSwitch"></label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            

                                            

                                            

                                            

                                            
                                            <div id="partnerInstructorInput"
                                                class="form-group mt-15 <?php echo e(!empty($webinar) && $webinar->partner_instructor ? '' : 'd-none'); ?>">
                                                <label
                                                    class="input-label d-block"><?php echo e(trans('public.select_a_partner_teacher')); ?></label>

                                                <select name="partners[]" class="form-control select2" multiple=""
                                                    data-placeholder="<?php echo e(trans('public.search_instructor')); ?>">
                                                    <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($teacher->id); ?>"
                                                            <?php echo e(!empty($webinar) && isset($webinarPartnerTeacher[$teacher->id]) ? 'selected' : ''); ?>>
                                                            <?php echo e($teacher->full_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="text-muted text-small mt-1">
                                                    <?php echo e(trans('admin/main.select_a_partner_hint')); ?></div>
                                            </div>

                                            


                                            <div class="form-group mt-15">
                                                <label class="input-label">Subject</label>

                                                <select id="categories"
                                                    class="custom-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="category_id" required>
                                                    <option <?php echo e(!empty($webinar) ? '' : 'selected'); ?> disabled>Select
                                                        Subject</option>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                            <optgroup label="<?php echo e($category->title); ?>">
                                                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($subCategory->id); ?>"
                                                                        <?php echo e((!empty($webinar) and $webinar->category_id == $subCategory->id) ? 'selected' : ''); ?>>
                                                                        <?php echo e($subCategory->title); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </optgroup>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($category->id); ?>"
                                                                <?php echo e((!empty($webinar) and $webinar->category_id == $category->id) ? 'selected' : ''); ?>>
                                                                <?php echo e($category->title); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback">
                                                        <?php echo e($message); ?>

                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group mt-15 <?php echo e((!empty($webinarCategoryFilters) and count($webinarCategoryFilters)) ? '' : 'd-none'); ?>"
                                        id="categoriesFiltersContainer">
                                        <span class="input-label d-block">Module Level</span>
                                        <div id="categoriesFiltersCard" class="row mt-3">

                                            <?php if(!empty($webinarCategoryFilters) and count($webinarCategoryFilters)): ?>
                                                <?php $__currentLoopData = $webinarCategoryFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-12 col-md-3">
                                                        <div class="webinar-category-filters ">
                                                            <strong
                                                                class="category-filter-title d-block"><?php echo e($filter->title); ?></strong>
                                                            <div class="py-10"></div>

                                                            <?php $__currentLoopData = $filter->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div
                                                                    class="form-group mt-3 d-flex align-items-center justify-content-between">
                                                                    <label class="text-gray font-14"
                                                                        for="filterOptions<?php echo e($option->id); ?>"><?php echo e($option->title); ?></label>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="filters[]"
                                                                            value="<?php echo e($option->id); ?>"
                                                                            <?php echo e(!empty($webinarFilterOptions) && in_array($option->id, $webinarFilterOptions) ? 'checked' : ''); ?>

                                                                            class="custom-control-input"
                                                                            id="filterOptions<?php echo e($option->id); ?>">
                                                                        <label class="custom-control-label"
                                                                            for="filterOptions<?php echo e($option->id); ?>"></label>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </section>

                                <?php if(!empty($webinar)): ?>
                                    

                                    <section id="chapter" class="mt-30 d-none">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line"><?php echo e(trans('public.chapters')); ?></h2>
                                            <button id="webinarAddChapter" type="button"
                                                class="btn btn-primary btn-sm mt-3"><?php echo e(trans('public.add_new_chapter')); ?></button>
                                        </div>

                                        <div class="row mt-10">
                                            <div class="col-12">
                                                <?php if(!empty($chapters) and !$chapters->isEmpty()): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th><?php echo e(trans('public.title')); ?></th>
                                                                <th><?php echo e(trans('admin/main.type')); ?></th>
                                                                <th><?php echo e(trans('public.parts')); ?></th>
                                                                <th><?php echo e(trans('admin/main.status')); ?></th>
                                                                <th></th>
                                                            </tr>

                                                            <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <th><?php echo e($chapter->title); ?></th>
                                                                    <th><?php echo e(trans('admin/main.' . $chapter->type)); ?></th>
                                                                    <th><?php echo e($chapter->getTopicsCount()); ?></th>
                                                                    <th><?php echo e(trans('admin/main.' . $chapter->status)); ?>

                                                                    </th>

                                                                    <td class="text-right">
                                                                        <button type="button"
                                                                            data-chapter-id="<?php echo e($chapter->id); ?>"
                                                                            data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                                                            class="edit-chapter btn-transparent text-primary mt-1"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="<?php echo e(trans('admin/main.edit')); ?>">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        <?php echo $__env->make('admin.includes.delete_button',
                                                                            [
                                                                                'url' =>
                                                                                    '/admin/chapters/' .
                                                                                    $chapter->id .
                                                                                    '/delete',
                                                                                'btnClass' => ' mt-1',
                                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <?php echo $__env->make('admin.includes.no-result', [
                                                        'file_name' => 'meet.png',
                                                        'title' => trans('public.sessions_no_result'),
                                                        'hint' => trans('public.sessions_no_result_hint'),
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </section>

                                    <?php if(!empty($webinar) && $webinar->isWebinar()): ?>
                                        <section class="mt-30 d-none">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h2 class="section-title after-line"><?php echo e(trans('public.sessions')); ?></h2>
                                                <button id="webinarAddSession" type="button"
                                                    class="btn btn-primary btn-sm mt-3"><?php echo e(trans('public.add_session')); ?></button>
                                            </div>

                                            <div class="row mt-10">
                                                <div class="col-12">
                                                    <?php if(!empty($sessions) and !$sessions->isEmpty()): ?>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped text-center font-14">

                                                                <tr>
                                                                    <th><?php echo e(trans('public.title')); ?></th>
                                                                    <th><?php echo e(trans('admin/main.session_api')); ?></th>
                                                                    <th><?php echo e(trans('public.date_time')); ?></th>
                                                                    <th><?php echo e(trans('public.duration')); ?></th>
                                                                    <th width="20%"><?php echo e(trans('public.link')); ?></th>
                                                                    <th><?php echo e(trans('admin/main.status')); ?></th>
                                                                    <th></th>
                                                                </tr>

                                                                <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <th>
                                                                            <span
                                                                                class="d-block"><?php echo e($session->title); ?></span>
                                                                            <?php if(!empty($session->chapter)): ?>
                                                                                <span
                                                                                    class="font-12 d-block"><?php echo e(trans('public.chapter')); ?>:
                                                                                    <?php echo e($session->chapter->title); ?></span>
                                                                            <?php endif; ?>
                                                                        </th>

                                                                        <th><?php echo e(trans('webinars.session_' . $session->session_api)); ?>

                                                                        </th>
                                                                        <td><?php echo e(dateTimeFormat($session->date, 'j F Y | H:i', true, false, $webinar->timezone)); ?>

                                                                        </td>
                                                                        <td><?php echo e($session->duration); ?>

                                                                            <?php echo e(trans('admin/main.min')); ?></td>
                                                                        <td><?php echo e($session->getJoinLink()); ?></td>
                                                                        <th><?php echo e(trans('admin/main.' . $session->status)); ?>

                                                                        </th>
                                                                        <td>
                                                                            <button type="button"
                                                                                data-session-id="<?php echo e($session->id); ?>"
                                                                                data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                                                                class="edit-session btn-transparent text-primary mt-1"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="<?php echo e(trans('admin/main.edit')); ?>">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>

                                                                            <?php echo $__env->make('admin.includes.delete_button',
                                                                                [
                                                                                    'url' =>
                                                                                        '/admin/sessions/' .
                                                                                        $session->id .
                                                                                        '/delete',
                                                                                    'btnClass' => ' mt-1',
                                                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </table>
                                                        </div>
                                                    <?php else: ?>
                                                        <?php echo $__env->make('admin.includes.no-result', [
                                                            'file_name' => 'meet.png',
                                                            'title' => trans('public.sessions_no_result'),
                                                            'hint' => trans('public.sessions_no_result_hint'),
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </section>
                                    <?php endif; ?>

                                    <section class="mt-30">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line">Material</h2>
                                            <div class="px-2 mt-3">
                                                <button id="webinarAddFile" type="button"
                                                    class="btn btn-primary btn-sm"><?php echo e(trans('public.add_file')); ?></button>
                                                
                                            </div>
                                        </div>

                                        <div class="row mt-10">
                                            <div class="col-12">
                                                <?php if(!empty($files) and !$files->isEmpty()): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th><?php echo e(trans('public.title')); ?></th>
                                                                <th><?php echo e(trans('public.source')); ?></th>
                                                                <th><?php echo e(trans('public.volume')); ?></th>
                                                                <th><?php echo e(trans('public.file_type')); ?></th>
                                                                <th><?php echo e(trans('public.accessibility')); ?></th>
                                                                <th><?php echo e(trans('admin/main.status')); ?></th>
                                                                <th></th>
                                                            </tr>

                                                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <th>
                                                                        <span class="d-block"><?php echo e($file->title); ?></span>
                                                                        <?php if(!empty($file->chapter)): ?>
                                                                            <span
                                                                                class="font-12 d-block"><?php echo e(trans('public.chapter')); ?>:
                                                                                <?php echo e($file->chapter->title); ?></span>
                                                                        <?php endif; ?>
                                                                    </th>
                                                                    <td><?php echo e(trans('update.file_source_' . $file->storage)); ?>

                                                                    </td>
                                                                    <td><?php echo e($file->volume); ?></td>
                                                                    <td><?php echo e(trans('update.file_type_' . $file->file_type)); ?>

                                                                    </td>
                                                                    <td><?php echo e($file->accessibility); ?></td>
                                                                    <th><?php echo e(trans('admin/main.' . $file->status)); ?></th>
                                                                    <td>
                                                                        <button type="button"
                                                                            data-file-id="<?php echo e($file->id); ?>"
                                                                            data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                                                            class="edit-file btn-transparent text-primary mt-1"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="<?php echo e(trans('admin/main.edit')); ?>">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        <?php echo $__env->make('admin.includes.delete_button',
                                                                            [
                                                                                'url' =>
                                                                                    '/admin/files/' .
                                                                                    $file->id .
                                                                                    '/delete',
                                                                                'btnClass' => ' mt-1',
                                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <?php echo $__env->make('admin.includes.no-result', [
                                                        'file_name' => 'files.png',
                                                        'title' => trans('public.files_no_result'),
                                                        'hint' => trans('public.files_no_result_hint'),
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </section>

                                    <?php if(!empty($webinar) && $webinar->isTextCourse()): ?>
                                        <section class="mt-30">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h2 class="section-title after-line"><?php echo e(trans('public.test_lesson')); ?>

                                                </h2>
                                                <button id="webinarAddTestLesson" type="button"
                                                    class="btn btn-primary btn-sm mt-3"><?php echo e(trans('public.add_text_lesson')); ?></button>
                                            </div>

                                            <div class="row mt-10">
                                                <div class="col-12">
                                                    <?php if(!empty($textLessons) and !$textLessons->isEmpty()): ?>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped text-center font-14">

                                                                <tr>
                                                                    <th><?php echo e(trans('public.title')); ?></th>
                                                                    <th><?php echo e(trans('public.time')); ?></th>
                                                                    <th><?php echo e(trans('public.attachments')); ?></th>
                                                                    <th><?php echo e(trans('public.accessibility')); ?></th>
                                                                    <th><?php echo e(trans('admin/main.status')); ?></th>
                                                                    <th></th>
                                                                </tr>

                                                                <?php $__currentLoopData = $textLessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $textLesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <th>
                                                                            <span
                                                                                class="d-block"><?php echo e($textLesson->title); ?></span>
                                                                            <?php if(!empty($textLesson->chapter)): ?>
                                                                                <span
                                                                                    class="font-12 d-block"><?php echo e(trans('public.chapter')); ?>:
                                                                                    <?php echo e($textLesson->chapter->title); ?></span>
                                                                            <?php endif; ?>
                                                                        </th>

                                                                        <td><?php echo e($textLesson->study_time); ?></td>
                                                                        <td>
                                                                            <?php if(count($textLesson->attachments) > 0): ?>
                                                                                <span
                                                                                    class="text-success"><?php echo e(trans('admin/main.yes')); ?>

                                                                                    (<?php echo e(count($textLesson->attachments)); ?>)
                                                                                </span>
                                                                            <?php else: ?>
                                                                                <span
                                                                                    class="text-dark"><?php echo e(trans('admin/main.no')); ?></span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td><?php echo e($textLesson->accessibility); ?></td>
                                                                        <th><?php echo e(trans('admin/main.' . $textLesson->status)); ?>

                                                                        </th>
                                                                        <td>
                                                                            <button type="button"
                                                                                data-text-id="<?php echo e($textLesson->id); ?>"
                                                                                data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                                                                class="edit-test-lesson btn-transparent text-primary mt-1"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="<?php echo e(trans('admin/main.edit')); ?>">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>

                                                                            <?php echo $__env->make('admin.includes.delete_button',
                                                                                [
                                                                                    'url' =>
                                                                                        '/admin/test-lesson/' .
                                                                                        $textLesson->id .
                                                                                        '/delete',
                                                                                    'btnClass' => ' mt-1',
                                                                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </table>
                                                        </div>
                                                    <?php else: ?>
                                                        <?php echo $__env->make('admin.includes.no-result', [
                                                            'file_name' => 'files.png',
                                                            'title' => trans('public.files_no_result'),
                                                            'hint' => trans('public.files_no_result_hint'),
                                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </section>
                                    <?php endif; ?>

                                    

                                    

                                    <section class="mt-30 d-none">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="section-title after-line"><?php echo e(trans('public.quiz_certificate')); ?>

                                            </h2>
                                            <button id="webinarAddQuiz" type="button"
                                                class="btn btn-primary btn-sm mt-3 d-none"><?php echo e(trans('public.add_quiz')); ?></button>
                                        </div>
                                        <div class="row mt-10">
                                            <div class="col-12">
                                                <?php if(!empty($webinarQuizzes) and !$webinarQuizzes->isEmpty()): ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped text-center font-14">

                                                            <tr>
                                                                <th><?php echo e(trans('public.title')); ?></th>
                                                                <th><?php echo e(trans('public.questions')); ?></th>
                                                                <th><?php echo e(trans('public.total_mark')); ?></th>
                                                                <th><?php echo e(trans('public.pass_mark')); ?></th>
                                                                <th><?php echo e(trans('public.certificate')); ?></th>
                                                                <th></th>
                                                            </tr>

                                                            <?php $__currentLoopData = $webinarQuizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinarQuiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <th><?php echo e($webinarQuiz->title); ?></th>
                                                                    <td><?php echo e($webinarQuiz->quizQuestions->count()); ?></td>
                                                                    <td><?php echo e($webinarQuiz->quizQuestions->sum('grade')); ?>

                                                                    </td>
                                                                    <td><?php echo e($webinarQuiz->pass_mark); ?></td>
                                                                    <td><?php echo e($webinarQuiz->certificate ? trans('public.yes') : trans('public.no')); ?>

                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            data-webinar-quiz-id="<?php echo e($webinarQuiz->id); ?>"
                                                                            data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                                                            class="edit-webinar-quiz btn-transparent text-primary mt-1"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="<?php echo e(trans('admin/main.edit')); ?>">
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>

                                                                        <?php echo $__env->make('admin.includes.delete_button',
                                                                            [
                                                                                'url' =>
                                                                                    '/admin/webinar-quiz/' .
                                                                                    $webinarQuiz->id .
                                                                                    '/delete',
                                                                                'btnClass' => ' mt-1',
                                                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                    </td>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                <?php else: ?>
                                                    <?php echo $__env->make('admin.includes.no-result', [
                                                        'file_name' => 'cert.png',
                                                        'title' => trans('public.quizzes_no_result'),
                                                        'hint' => trans('public.quizzes_no_result_hint'),
                                                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </section>
                                <?php endif; ?>

                                

                                <input type="hidden" name="draft" value="no" id="forDraft" />

                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" id="saveAndPublish"
                                            class="btn btn-success"><?php echo e(!empty($webinar) ? trans('admin/main.save_and_publish') : 'Save and Next Step'); ?></button>

                                        <?php if(!empty($webinar)): ?>
                                            

                                            <?php echo $__env->make('admin.includes.delete_button', [
                                                'url' => '/admin/webinars/' . $webinar->id . '/delete',
                                                'btnText' => trans('public.delete'),
                                                'hideDefaultClass' => true,
                                                'btnClass' => 'btn btn-danger',
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </form>


                            <?php echo $__env->make('admin.webinars.modals.prerequisites', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.ticket', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.chapter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.session', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.interactive_file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.faq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.webinars.modals.testLesson', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var saveSuccessLang = '<?php echo e(trans('webinars.success_store')); ?>';
        var zoomJwtTokenInvalid = '<?php echo e(trans('admin/main.teacher_zoom_jwt_token_invalid')); ?>';
        var filePathPlaceHolderBySource = {
            upload: '<?php echo e(trans('update.file_source_upload_placeholder')); ?>',
            youtube: '<?php echo e(trans('update.file_source_youtube_placeholder')); ?>',
            vimeo: '<?php echo e(trans('update.file_source_vimeo_placeholder')); ?>',
            external_link: '<?php echo e(trans('update.file_source_external_link_placeholder')); ?>',
            google_drive: '<?php echo e(trans('update.file_source_google_drive_placeholder')); ?>',
            dropbox: '<?php echo e(trans('update.file_source_dropbox_placeholder')); ?>',
            iframe: '<?php echo e(trans('update.file_source_iframe_placeholder')); ?>',
            s3: '<?php echo e(trans('update.file_source_s3_placeholder')); ?>',
        }
    </script>

    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/moment.min.js"></script>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets/default/vendors/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <script src="/assets/default/vendors/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/admin/js/webinar.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/Code/lms/resources/views/admin/webinars/create.blade.php ENDPATH**/ ?>