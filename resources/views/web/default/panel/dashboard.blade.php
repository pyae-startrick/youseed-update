@extends(getTemplate() . '.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/chartjs/chart.min.css" />
    <link rel="stylesheet" href="/assets/default/vendors/apexcharts/apexcharts.css" />
@endpush

@section('content')
    <section class="dashboard mobile-panel-w" style="padding: 30px 50px;margin-bottom: 100px;">

        <h3 class="mobile-panel-h2 font-20 mb-30 text-center text-dark-blue font-weight-bold">Welcome</h3>
        <div style="width:40px;height:2px;background: #000;margin: auto;"></div>
        <div class="row">
            

            @foreach ($authUser->getUnreadNoticeboards() as $getUnreadNoticeboard)
                <div class="col-12 col-lg-4 mt-35">
                    <div style="height: 200px" class="bg-white noticeboard rounded-sm panel-shadow py-5 py-md-10 px-10 px-md-20">
                        <div class="noticeboard-item py-15">
                            <div style="margin-bottom: 93px;" class=" d-flex align-items-center justify-content-between">
                                <div class="w-50">
                                    <h4 class="js-noticeboard-title font-weight-500 text-secondary">{!! truncate($getUnreadNoticeboard->title, 150) !!}
                                    </h4>
                                </div>

                                <div>
                                    <button type="button" data-id="{{ $getUnreadNoticeboard->id }}"
                                        class="js-noticeboard-info btn btn-sm btn-border-white">{{ trans('panel.more_info') }}</button>
                                    <input type="hidden" class="js-noticeboard-message"
                                        value="{{ $getUnreadNoticeboard->message }}">
                                </div>
                            </div>
                            <div style="position: absolute;
                            bottom: 22px;" class="font-12 text-gray mt-5">
                                <span class="mr-5">{{ trans('public.created_by') }}
                                    {{ $getUnreadNoticeboard->sender }}</span>
                                |
                                <span
                                    class="js-noticeboard-time ml-5">{{ dateTimeFormat($getUnreadNoticeboard->created_at, 'j M Y | H:i') }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach



        </div>
    </section>
    <section class="" style="height: 300px;background-color:#fff;">
        <div style="width: 94%;
        margin: auto;
        padding: 20px 30px !important;
        border-radius: 30px !important;
        background: #43d477 !important;
        top: -36px;" class="bg-white dashboard-banner-container position-relative px-15 px-ld-35 py-10 panel-shadow rounded-sm">
            <h2 class="font-30 text-white line-height-1 ">
                <span class="d-block">{{ trans('panel.hi') }} {{ $authUser->full_name }},</span>
            </h2>

            {{-- <div class="dashboard-banner">
                <img src="{{ getPageBackgroundSettings('dashboard') }}" alt="" class="img-cover">
            </div> --}}
        </div>
    </section>



    <div class="d-none" id="iNotAvailableModal">
        <div class="offline-modal">
            <h3 class="section-title after-line">{{ trans('panel.offline_title') }}</h3>
            <p class="mt-20 font-16 text-gray">{{ trans('panel.offline_hint') }}</p>

            <div class="form-group mt-15">
                <label>{{ trans('panel.offline_message') }}</label>
                <textarea name="message" rows="4" class="form-control ">{{ $authUser->offline_message }}</textarea>
                <div class="invalid-feedback"></div>
            </div>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button"
                    class="js-save-offline-toggle btn btn-primary btn-sm">{{ trans('public.save') }}</button>
                <button type="button" class="btn btn-danger ml-10 close-swl btn-sm">{{ trans('public.close') }}</button>
            </div>
        </div>
    </div>

    <div class="d-none" id="noticeboardMessageModal">
        <div class="text-center">
            <h3 class="modal-title font-20 font-weight-500 text-dark-blue"></h3>
            <span class="modal-time d-block font-12 text-gray mt-25"></span>
            <p class="modal-message font-weight-500 text-gray mt-4"></p>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    {{-- <script src="/assets/default/vendors/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="/assets/default/vendors/chartjs/chart.min.js"></script> --}}

    <script>
        var offlineSuccess = '{{ trans('panel.offline_success') }}';
        var $chartDataMonths = @json($monthlyChart['months']);
        var $chartData = @json($monthlyChart['data']);
    </script>

    {{-- <script src="/assets/default/js/panel/dashboard.min.js"></script> --}}
@endpush
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
     $(document).ready(function() {
        $('.js-noticeboard-info').on('click', function (e) {
        const $this = $(this);
        const noticeboard_id = $this.attr('data-id');
        const card = $this.closest('.noticeboard-item');
        const title = card.find('.js-noticeboard-title').text();
        const time = card.find('.js-noticeboard-time').text();
        const message = card.find('.js-noticeboard-message').val();

        const modal = $('#noticeboardMessageModal');
        modal.find('.modal-title').text(title);
        modal.find('.modal-time').text(time);
        modal.find('.modal-message').html(message);


        Swal.fire({
            html: modal.html(),
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            customClass: {
                content: 'p-0 text-left',
            },
            width: '30rem',
        });

        if (!$this.hasClass('seen-at')) {
            $.get('/panel/noticeboard/' + noticeboard_id + '/saveStatus', function () {
            })
        }
    });
        })
</script>
