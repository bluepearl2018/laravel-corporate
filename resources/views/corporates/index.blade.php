@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\ListFacade::display('corporate', 'corporate')}}
@endsection
