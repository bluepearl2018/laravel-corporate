@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\CreateFacade::display('corporate', 'corporate-agreement', 'admin')}}
@endsection