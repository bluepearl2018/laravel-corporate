@extends('corporate::layouts.master')
@section('content')
	{{ \Eutranet\Commons\Facades\ShowFacade::display('corporate', 'staff-member', Auth::id()) }}
@endsection