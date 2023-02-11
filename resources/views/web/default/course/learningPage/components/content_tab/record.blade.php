{{-- {{dd($course->sessions[0]->id)}} --}}
@push('styles_top')
    {{-- <link rel="stylesheet" href="/assets/admin/vendor/bootstrap/bootstrap.min.css"/> --}}
@endpush
<div class="tab-item align-items-start p-10" style="justify-content: space-between"
    data-type="{{ \App\Models\WebinarChapter::$chapterSession }}" data-id="{{ $course->sessions[0]->id }}">

    @if (!empty($get_meetings))

        @foreach ($get_meetings as $meeting)
            @if ($meeting->state != 'deleted')
                {{-- {{dd($meeting)}} --}}
                @if (!empty($meeting))
                    @if (!empty($meeting->metadata))
                        <div class="">
                            <span id='test'
                                class="font-weight-500 font-14 text-dark-blue d-block">{{ $meeting->metadata->meetingName }}</span>
                            <span class="font-12 text-gray d-block">
                                <a href="{{ !empty($meeting->playback->format->url) ? $meeting->playback->format->url : 'ew' }}"
                                    target="_blank" rel="noopener noreferrer">
                                    Click here to view record
                                </a>
                            </span>
                            <span class="font-12 text-black d-block">
                                <?php
                                $mil = $meeting->startTime;
                                $seconds = $mil / 1000;
                                echo date('d/m/Y', $seconds);
                                ?>
                            </span>
                        </div>
                        <div>
                            {{-- <form action="/course/learning/record/{{$meeting->recordID}}/delete" method="get">
                            @csrf
                            <button type="submit" 
                            style="background-color: red;
                            color: white;
                            border-radius: 10px;display: {{$user->role_name == 'user' ? 'none' : 'block'}};" {{$user->role_name == 'user' ? 'disabled' : ''}}>Delete</button>
                        </form> --}}
                            @include('admin.includes.delete_button_learning', [
                                'url' => '/course/learning/record/' . $meeting->recordID . ' /delete',
                                'btnClass' => 'btn-sm',
                                'btnText' => 'Delete',
                                'user' => $user,
                            ])

                        </div>
                    @endif
                @endif
            @endif
        @endforeach
    @else
        No Class Recording available.
    @endif

</div>




<script>

//     setInterval(function(){
//         window.location.reload();
//     }, 2000);
// console.log('we');
    // Basic confirm box
</script>
