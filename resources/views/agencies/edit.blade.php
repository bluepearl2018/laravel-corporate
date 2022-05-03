@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\EditFacade::display('corporate', 'agency', $agency->id)}}
@endsection