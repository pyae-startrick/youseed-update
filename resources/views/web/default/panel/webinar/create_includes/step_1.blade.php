@push('styles_top')
    {{-- <link rel="stylesheet" href="/assets/admin/vendor/bootstrap/bootstrap.min.css"> --}}

    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">


    <style>
        .select2-container--default .select2-selection--multiple {
            height: auto !important;
        }
    </style>
@endpush

<div>
    <div class="row">
        <div class="col-12 col-md-4 mt-15">

            @if (!empty(getGeneralSettings('content_translate')))
                <div class="form-group d-none">
                    <label class="input-label">{{ trans('auth.language') }}</label>
                    <select name="locale" class="custom-select {{ !empty($webinar) ? 'js-edit-content-locale' : '' }}">
                        @foreach ($userLanguages as $lang => $language)
                            <option value="{{ $lang }}" @if (mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>
                                {{ $language }}
                                {{ (!empty($definedLanguage) and is_array($definedLanguage) and in_array(mb_strtolower($lang), $definedLanguage)) ? '(' . trans('public.content_defined') . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
                <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
            @endif


            <div class="form-group mt-15 d-none">
                <label class="input-label d-block">{{ trans('panel.course_type') }}</label>

                <select name="type" class="custom-select @error('type') is-invalid @enderror">
                    <option value="webinar" selected>
                        {{ trans('webinars.webinar') }}</option>
                    {{-- <option value="course" @if (!empty($webinar) and $webinar->type == 'course') selected @endif>
                        {{ trans('webinars.video_course') }}</option>
                    <option value="text_lesson" @if (!empty($webinar) and $webinar->type == 'text_lesson') selected @endif>
                        {{ trans('webinars.text_lesson') }}</option> --}}
                </select>

                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            {{-- @if ($isOrganization)
                <div class="form-group mt-15 ">
                    <label class="input-label d-block">{{ trans('public.select_a_teacher') }}</label>

                    <select name="teacher_id" class="custom-select @error('teacher_id') is-invalid @enderror">
                        <option {{ !empty($webinar) ? '' : 'selected' }} disabled>
                            {{ trans('public.choose_instructor') }}</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ !empty($webinar) && $webinar->teacher_id === $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->full_name }}</option>
                        @endforeach
                    </select>

                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif --}}


            <div class="form-group mt-15">
                <label class="input-label">{{ trans('public.title') }}</label>
                <input type="text" name="title"
                    value="{{ (!empty($webinar)) ? $webinar->translations[0]->title : old('title') }}"
                    class="form-control @error('title') is-invalid @enderror" placeholder="" />
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            @if (!empty($students))
                <div class="form-group mt-15 ">
                    <label class="input-label d-block">Select an Students</label>

                    <select multiple name="student[]"
                        class="form-control select2 @error('student') is-invalid @enderror"
                        data-placeholder="Search an student">
                        {{-- <option {{ !empty($webinar) ? '' : 'selected' }} disabled>Select an Students</option> --}}
                        @foreach ($students as $student)
                            @if (old('student'))
                                <option value="{{ $student->student_id }}"
                                    {{ in_array($student->id, old('student')) ?? [] ? 'selected' : '' }}>
                                    [{{ $student->id }}] {{ $student->student_name }}</option>
                            @else
                                @if (!empty($webinar))
                                    <option value="{{ $student->student_id }}" <?php foreach ($sales as $sale) {
                                        if ($student->student_id == $sale->buyer_id) {
                                            echo 'selected';
                                        }
                                    } ?>>
                                        [{{ $student->student_id }}] {{ $student->student_name }}
                                    </option>
                                @else
                                    <option value="{{ $student->student_id }}">
                                        [{{ $student->student_id }}] {{ $student->student_name }}
                                    </option>
                                @endif
                            @endif
                        @endforeach

                    </select>

                    @error('student')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            <div class="form-group mt-15 d-none">
                <label class="input-label">{{ trans('public.seo_description') }}</label>
                <input type="text" name="seo_description"
                    value="{{ (!empty($webinar)) ? $webinar->translations[0]->description : old('seo_description') }}"
                    class="form-control @error('seo_description') is-invalid @enderror "
                    placeholder="{{ trans('forms.50_160_characters_preferred') }}" />
                @error('seo_description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mt-15">
                <label class="input-label">{{ trans('public.thumbnail_image') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="input-group-text panel-file-manager" data-input="thumbnail"
                            data-preview="holder">
                            <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                        </button>
                    </div>
                    <input type="text" name="thumbnail" id="thumbnail"
                        value="{{ !empty($webinar) ? $webinar->thumbnail : old('thumbnail') }}"
                        class="form-control @error('thumbnail') is-invalid @enderror"
                        placeholder="{{ trans('forms.course_thumbnail_size') }}" />
                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-15 d-none">
                <label class="input-label">{{ trans('public.cover_image') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="input-group-text panel-file-manager" data-input="cover_image"
                            data-preview="holder">
                            <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                        </button>
                    </div>
                    <input type="text" name="image_cover" id="cover_image"
                        value="{{ !empty($webinar) ? $webinar->image_cover : old('image_cover') }}"
                        placeholder="{{ trans('forms.course_cover_size') }}"
                        class="form-control @error('image_cover') is-invalid @enderror" />
                    @error('image_cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-25 d-none">
                <label class="input-label">{{ trans('public.demo_video') }} ({{ trans('public.optional') }})</label>

                <div class="">
                    <label class="input-label font-12">{{ trans('public.source') }}</label>
                    <select name="video_demo_source" class="js-video-demo-source form-control">
                        @foreach (\App\Models\Webinar::$videoDemoSource as $source)
                            <option value="{{ $source }}" @if (!empty($webinar) and $webinar->video_demo_source == $source) selected @endif>
                                {{ trans('update.file_source_' . $source) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mt-0 d-none">
                <label class="input-label font-12">{{ trans('update.path') }}</label>
                <div class="input-group js-video-demo-path-input">
                    <div class="input-group-prepend">
                        <button type="button"
                            class="js-video-demo-path-upload input-group-text text-white panel-file-manager {{ (empty($webinar) or empty($webinar->video_demo_source) or $webinar->video_demo_source == 'upload') ? '' : 'd-none' }}"
                            data-input="demo_video" data-preview="holder">
                            <i data-feather="upload" width="18" height="18" class="text-white"></i>
                        </button>

                        <button type="button"
                            class="js-video-demo-path-links rounded-left input-group-text input-group-text-rounded-left text-white {{ (empty($webinar) or empty($webinar->video_demo_source) or $webinar->video_demo_source == 'upload') ? 'd-none' : '' }}">
                            <i data-feather="link" width="18" height="18" class="text-white"></i>
                        </button>
                    </div>
                    <input type="text" name="video_demo" id="demo_video"
                        value="{{ !empty($webinar) ? $webinar->video_demo : old('video_demo') }}"
                        class="form-control @error('video_demo') is-invalid @enderror" />
                    @error('video_demo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="input-label">{{ trans('public.description') }}</label>
                <textarea id="" name="description" rows="10"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Maximun 300 words.">{!! (!empty($webinar))
                        ? $webinar->translations[0]->description
                        : old('description') !!}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group mt-15">
        <label class="input-label">{{ trans('public.capacity') }}</label>
        <input type="text" name="capacity"
            value="{{ (!empty($webinar) and !empty($webinar->capacity)) ? $webinar->capacity : old('capacity') }}"
            class="form-control @error('capacity') is-invalid @enderror"
            placeholder="{{ trans('forms.capacity_placeholder') }}" />
        @error('capacity')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label class="input-label">{{ trans('public.start_date') }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="dateInputGroupPrepend">
                    <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                </span>
            </div>
            <input type="text" name="start_date"
                value="{{ (!empty($webinar) and $webinar->start_date) ? dateTimeFormat($webinar->start_date, 'Y-m-d H:i', false, false, $webinar->timezone) : old('start_date') }}"
                class="form-control @error('start_date') is-invalid @enderror datetimepicker"
                aria-describedby="dateInputGroupPrepend" />
            @error('start_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group mt-15">
        <label class="input-label">Subject</label>

        <select id="categories" class="custom-select @error('category_id') is-invalid @enderror" name="category_id"
            required>
            <option {{ (!empty($webinar) and !empty($webinar->category_id)) ? '' : 'selected' }} disabled>
                Select Subject</option>
            @foreach ($categories as $category)
                @if (!empty($category->subCategories) and $category->subCategories->count() > 0)
                    <optgroup label="{{ $category->title }}">
                        @foreach ($category->subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ (!empty($webinar) and $webinar->category_id == $subCategory->id or old('category_id') == $subCategory->id) ? 'selected' : '' }}>
                                {{ $subCategory->title }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $category->id }}"
                        {{ (!empty($webinar) and $webinar->category_id == $category->id or old('category_id') == $category->id) ? 'selected' : '' }}>
                        {{ $category->title }}</option>
                @endif
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group mt-15 {{ (!empty($webinarCategoryFilters) and count($webinarCategoryFilters)) ? '' : 'd-none' }}"
        id="categoriesFiltersContainer">
        <span class="input-label d-block">Module Level</span>
        <div id="categoriesFiltersCard" class="row mt-20">

            @if (!empty($webinarCategoryFilters) and count($webinarCategoryFilters))
                @foreach ($webinarCategoryFilters as $filter)
                    <div class="col-12 col-md-3">
                        <div class="webinar-category-filters">
                            <strong class="category-filter-title d-block">{{ $filter->title }}</strong>
                            <div class="py-10"></div>

                            @php
                                $webinarFilterOptions = $webinar->filterOptions->pluck('filter_option_id')->toArray();
                                
                                if (!empty(old('filters'))) {
                                    $webinarFilterOptions = array_merge($webinarFilterOptions, old('filters'));
                                }
                            @endphp

                            @foreach ($filter->options as $option)
                                <div class="form-group mt-10 d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer font-14 text-gray"
                                        for="filterOptions{{ $option->id }}">{{ $option->title }}</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="filters[]" value="{{ $option->id }}"
                                            {{ !empty($webinarFilterOptions) && in_array($option->id, $webinarFilterOptions) ? 'checked' : '' }}
                                            class="custom-control-input" id="filterOptions{{ $option->id }}">
                                        <label class="custom-control-label"
                                            for="filterOptions{{ $option->id }}"></label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>


    @if ($isOrganization)
        <div class="row">
            <div class="col-6">

                <div class="form-group mt-30 d-flex align-items-center">
                    <label class="cursor-pointer mb-0 input-label"
                        for="privateSwitch">{{ trans('webinars.private') }}</label>
                    <div class="ml-30 custom-control custom-switch">
                        <input type="checkbox" name="private" class="custom-control-input" id="privateSwitch"
                            {{ (!empty($webinar) and $webinar->private) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="privateSwitch"></label>
                    </div>
                </div>

                <p class="text-gray font-12">{{ trans('webinars.create_private_course_hint') }}</p>
            </div>
        </div>
    @endif
</div>
@push('scripts_bottom')
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>


    @push('scripts_bottom')
        <script>
            var videoDemoPathPlaceHolderBySource = {
                upload: '{{ trans('update.file_source_upload_placeholder') }}',
                youtube: '{{ trans('update.file_source_youtube_placeholder') }}',
                vimeo: '{{ trans('update.file_source_vimeo_placeholder') }}',
                external_link: '{{ trans('update.file_source_external_link_placeholder') }}',
            }
        </script>
    @endpush
@endpush
{{-- <img style="width:100%;" src="/assets/default/img/home/no-access.jpg" alt=""> --}}
