@extends('emails.email')

@section('content')
    <h3>投诉与反馈：</h3>
    <p>{{ $data['feedback'] }}</p>
@endsection
