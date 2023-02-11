<div class="tab-pane mt-3 fade" id="images" role="tabpanel" aria-labelledby="images-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="/admin/users/{{ $user->id .'/updateImage' }}" method="Post">
                {{ csrf_field() }}

                <div class="form-group mt-15">
                    <label class="input-label">{{ trans('admin/main.avatar') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="input-group-text admin-file-manager" data-input="avatar" data-preview="holder">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                        <input type="text" name="avatar" id="avatar" value="{{ !empty($user->avatar) ? $user->getAvatar() : old('image_cover') }}" class="form-control" autofocus/>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text admin-file-view" data-input="avatar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-15 d-none">
                    <label class="input-label">{{ trans('admin/main.cover_image') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text admin-file-manager" data-input="cover_img" data-preview="holder">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                        <input type="text" name="cover_img" id="cover_img" value="{{ !empty($user->cover_img) ? $user->cover_img : old('image_cover') }}" class="form-control"/>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text admin-file-view" data-input="cover_img">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <div class=" mt-4">
                    <button class="btn btn-primary">{{ trans('admin/main.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts_bottom')
    <script>
        (function($) {
            "use strict";

            @if (session()->has('sweetalert'))
                Swal.fire({
                    icon: "{{ session()->get('sweetalert')['status'] ?? 'success' }}",
                    html: '<h3 class="font-20 text-center text-dark-blue py-25">{{ session()->get('sweetalert')['msg'] ?? '' }}</h3>',
                    showConfirmButton: true,
                    width: '25rem',
                });
            @endif


                $('body').on('click', '.admin-file-manager', function (e) {
        e.preventDefault();
        $(this).filemanager('file', {prefix: '/laravel-filemanager'})
    });

        })(jQuery)
    </script>
@endpush
