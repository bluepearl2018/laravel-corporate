@extends('corporate::layouts.master')
@section('content')
	{{ \Eutranet\Commons\Facades\EditFacade::display('corporate', 'user', $user->id) }}
@endsection