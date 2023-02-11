<div class="tab-item d-flex align-items-start p-10" style="overflow-x: scroll;" data-type="{{ $type }}"
    data-id="{{ $item->id }}">

    {{-- <span class="chapter-icon bg-gray300 mr-10">
            @php
                $icon = '';
                $hintText= '';

                if ($type == \App\Models\WebinarChapter::$chapterSession) {
                    $icon = 'video';
                    $hintText = dateTimeFormat($item->date, 'j M Y  H:i') . ' | ' . $item->duration . ' ' . trans('public.min');
                } elseif ($type == \App\Models\WebinarChapter::$chapterFile) {
                    $hintText = $item->file_type . ($item->volume > 0 ? ' | '.$item->volume : '');

                    $icon = $item->getIconByType();
                } elseif ($type == \App\Models\WebinarChapter::$chapterTextLesson) {
                    $icon = 'file-text';
                    $hintText= $item->study_time . ' ' . trans('public.min');
                }
            @endphp

            <i data-feather="{{ $icon }}" class="text-gray" width="16" height="16"></i>
        </span> --}}

    <div>
        {{-- @foreach ($get_meetings as $item)
            @if ($item->state != 'deleted')
                <div class="">
                    <span
                        class="font-weight-500 font-14 text-dark-blue d-block">{{ $item->metadata->meetingName }}</span>
                    <span class="font-12 text-gray d-block">
                        <a class="text-gray" href="{{ $item->playback->format->url }}" target="_blank" rel="noopener noreferrer">
                            Click here to view record playback

                        </a></span>
                    <span class="font-12 text-black d-block">
                        <?php 
                            $mil = $item->startTime;
                            $seconds = $mil / 1000;
                           echo date('d/m/Y', $seconds);
                        ?>
                    </span>
                </div>
            @endif
        @endforeach --}}



        {{-- <div class="tab-item-info mt-15">
            <p class="font-12 text-gray d-block">
                @php
                    $description = !empty($item->description) ? $item->description : (!empty($item->summary) ? $item->summary : '');
                @endphp

                {!! truncate($description, 150) !!}
            </p>
        </div> --}}
    </div>
</div>
