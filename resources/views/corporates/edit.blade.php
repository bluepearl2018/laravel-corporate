@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\EditFacade::display('corporate', 'corporate', $corporate->id)}}
@endsection