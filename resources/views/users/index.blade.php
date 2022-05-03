@extends('corporate::layouts.master')
@section('content')
	{{ \Eutranet\Commons\Facades\TableFacade::display('corporate', 'user', isset($userStatus) ? ['user_status_id',  $userStatus->id] : [] ) }}
@endsection