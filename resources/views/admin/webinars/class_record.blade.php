@extends('admin.layouts.app')

@push('libraries_top')
@endpush

@section('content')
    <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">{{ trans('admin/main.search') }}</label>
                            <input placeholder="Enter Session ID" name="class_id" type="number" class="form-control"
                                value="{{ request()->get('class_id') }}">
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group mt-1">
                            <label class="input-label mb-4"> </label>
                            <input type="submit" class="text-center btn btn-primary w-100"
                                value="{{ trans('admin/main.show_results') }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">Classes</div>

                <div class="breadcrumb-item">records</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="{{ url('/admin/webinars/recordmultidelete') }}" method="post">
                                    @csrf
                                    <input class="btn btn-primary" type="submit" name="submit"
                                        value="Delete Selected Record" />
                                    <br />
                                    <br />
                                    <table id="recordList" class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left"> <input type="checkbox" id="checkAll"> Select All</th>
                                            <th>Session ID</th>
                                            {{-- <th class="text-left">Class Name</th> --}}
                                            <th class="text-left">Session Name</th>
                                            <th class="text-left">Status</th>
                                            <th class="text-left">Plyback Type</th>
                                            <th class="text-left">Plyback URL</th>
                                            <th class="text-left">Size</th>
                                            <th width="120">{{ trans('admin/main.actions') }}</th>
                                        </tr>
                                        {{-- <tbody> --}}
                                        @if (!$meetingID == [])
                                            @foreach ($get_meetings as $meeting)
                                                @if ($meeting->state != 'deleted')
                                                    <tr class="text-center newTable">
                                                        <td class="text-center"><input name='id[]' type="checkbox"
                                                                id="checkItem" value="{{ $meeting->recordID }}">
                                                        </td>
                                                        <td>{{ $meeting->meetingID }}</td>
                                                        {{-- <td>
                                                            <a href="{{ 'https://lms.startrick.com/course/learning/' . $slug_name->slug }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                {{ trim($slug_name->slug, '-') }}
                                                            </a>
                                                        </td> --}}
                                                        <td class="text-left">{{ $meeting->metadata->meetingName }}</td>
                                                        <td class="text-left">{{ $meeting->state }}</td>
                                                        <td class="text-left">{{ $meeting->playback->format->type }}</td>
                                                        <td class="text-left">
                                                            <a href="{{ $meeting->playback->format->url }}" target="_blank"
                                                                rel="noopener noreferrer">
                                                                {{ $meeting->playback->format->url }}

                                                            </a>
                                                        </td>
                                                        <td class="text-left">@php echo App\Http\Controllers\Admin\WebinarController::formatBytes($meeting->playback->format->size) @endphp</td>


                                                        <td width="120" class="btn-sm">
                                                            @can('admin_webinars_delete')
                                                                @include('admin.includes.delete_button', [
                                                                    'url' =>
                                                                        '/admin/webinars/record/' .
                                                                        $meeting->recordID .
                                                                        '/delete',
                                                                    'btnClass' => 'btn-sm mt-1',
                                                                ])
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if ($get_meetings == [])
                                            <tr class="text-center">
                                                <td class="text-center">No Recording Available !</td>
                                            </tr>
                                        @endif
                                        {{-- </tbody> --}}
                                    </table>
                                </form>
                            </div>
                        </div>

                        {{-- <div class="card-footer text-center">
                            {{ $query->appends(request()->input())->links() }}
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script language="javascript">
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        var count = $('#recordList tr').length;
        console.log('he');
        var tbodyRef = document.getElementById('recordList').getElementsByTagName('tbody')[0];

// Insert a row at the end of table
var newRow = tbodyRef.insertRow();

// Insert a cell at the end of the row
var newCell = newRow.insertCell();

// Append a text node to the cell
var newText = document.createTextNode('No Recording Available !');
if(count == 1) {
    newCell.appendChild(newText);

}
    </script>
@endpush
