@extends('corporate::layouts.master')
@section('content')
	{{\Eutranet\Commons\Facades\EditFacade::display('corporate', 'staff-member', $staffMember->id)}}
@endsection