<!-- Modal -->
<div class="d-none" id="webinarSessionModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">{{ trans('public.add_session') }}</h3>

    <form action="/admin/sessions/store" method="post" class="session-form">
        <input type="hidden" name="webinar_id" value="{{ !empty($webinar) ? $webinar->id :''  }}">

        @if(!empty(getGeneralSettings('content_translate')))
            <div class="form-group">
                <label class="input-label">{{ trans('auth.language') }}</label>
                <select name="locale" class="form-control ">
                    @foreach($userLanguages as $lang => $language)
                        <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
                    @endforeach
                </select>
                @error('locale')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        @else
            <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
        @endif


        <div class="form-group">
            <label class="input-label">{{ trans('webinars.select_session_api') }}</label>

            <div class="js-session-api">
                {{-- <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="localApi_record" value="local" checked class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="localApi_record">{{ trans('webinars.session_local_api') }}</label>
                </div> --}}

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="bigBlueButton_record" value="big_blue_button" checked class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="bigBlueButton_record">{{ trans('webinars.session_big_blue_button') }}</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="zoomApi_record" value="zoom" class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="zoomApi_record">{{ trans('webinars.session_zoom') }}</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" name="session_api" id="agoraApi_record" value="agora" class="js-api-input custom-control-input">
                    <label class="custom-control-label" for="agoraApi_record">{{ trans('update.agora') }}</label>
                </div>
            </div>

            <div class="invalid-feedback"></div>

            <div class="js-zoom-not-complete-alert mt-10 text-danger d-none">
                {{ trans('admin/main.teacher_zoom_jwt_token_invalid') }}
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.chapter') }}qwe</label>
            <select class="custom-select" name="chapter_id">
                <option value="">{{ trans('admin/main.no_chapter') }}</option>

                @if(!empty($chapters))
                    @foreach($chapters->where('type',\App\Models\WebinarChapter::$chapterSession) as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group js-api-secret">
            <label class="input-label">{{ trans('auth.password') }}</label>
            <input type="text" name="api_secret" class="js-ajax-api_secret form-control" value=""/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group js-moderator-secret">
            <label class="input-label">{{ trans('public.moderator_password') }}</label>
            <input type="text" name="moderator_secret" class="js-ajax-moderator_secret form-control" value=""/>
            <div class="invalid-feedback"></div>
        </div>


        <div class="form-group">
            <label class="input-label">{{ trans('public.title') }}</label>
            <input type="text" name="title" class="form-control" placeholder="{{ trans('forms.maximum_255_characters') }}"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.date') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="dateRangeLabel">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <input type="text" name="date" class="js-ajax-date form-control datetimepicker" aria-describedby="dateRangeLabel"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">{{ trans('public.duration') }} <span class="braces">({{ trans('public.minutes') }})</span></label>
            <input type="text" name="duration" class="js-ajax-duration form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div>

        {{-- <div class="form-group js-local-link">
            <label class="input-label">{{ trans('public.link') }}</label>
            <input type="text" name="link" class="js-ajax-link form-control" placeholder=""/>
            <div class="invalid-feedback"></div>
        </div> --}}

        <div class="form-group">
            <label class="input-label">{{ trans('public.description') }}</label>
            <textarea name="description" class="form-control" rows="6"></textarea>
            <div class="invalid-feedback"></div>
        </div>

        <div class="js-session-status form-group mt-3">
            <div class="d-flex align-items-center justify-content-between">
                <label class="cursor-pointer input-label" for="sessionStatusSwitch_record">{{ trans('admin/main.active') }}</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="status" checked class="custom-control-input" id="sessionStatusSwitch_record">
                    <label class="custom-control-label" for="sessionStatusSwitch_record"></label>
                </div>
            </div>
        </div>

        <div class="js-agora-chat-and-rec d-none">
            @if(getFeaturesSettings('agora_chat'))
                <div class="form-group mt-20">
                    <div class="d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="sessionAgoraChatSwitch_record">{{ trans('update.chat') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="agora_chat" class="custom-control-input" id="sessionAgoraChatSwitch_record">
                            <label class="custom-control-label" for="sessionAgoraChatSwitch_record"></label>
                        </div>
                    </div>
                </div>
            @endif

            {{--
                <div class="form-group mt-20">
                    <div class="d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="sessionAgoraRecordSwitch_record">{{ trans('update.record') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="agora_record" class="custom-control-input" id="sessionAgoraRecordSwitch_record" >
                            <label class="custom-control-label" for="sessionAgoraRecordSwitch_record"></label>
                        </div>
                    </div>
                </div>
            --}}

        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveSession" class="btn btn-primary">{{ trans('public.save') }}</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">{{ trans('public.close') }}</button>
        </div>
    </form>
</div>
