@extends('web.default.layouts.email')

@section('body')
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        {{-- <h1 class="h1">{{ $contact->subject }}</h1> --}}
        <p>Name : {{ $contact['name'] }}</p>
        <p>Age: {{$contact['age']}}</p>
        <p>Whatsapp: {{$contact['whatsapp']}}</p>
    </td>
@endsection