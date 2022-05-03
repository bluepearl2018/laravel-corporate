@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\ShowFacade::display('corporate', 'corporate', $corporate->id)}}
@endsection