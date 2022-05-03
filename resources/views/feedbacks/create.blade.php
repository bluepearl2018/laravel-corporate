@extends('layouts.back.users')
@section('content')
    @php($yesterdayDate = \Carbon\Carbon::yesterday()->format('Y-m-d'))
    @php($todayDate = \Carbon\Carbon::today()->format('Y-m-d'))
    @php($tomorrowDate = \Carbon\Carbon::tomorrow()->format('Y-m-d'))
    FOLLOW UP FEEDBACK
@endsection
