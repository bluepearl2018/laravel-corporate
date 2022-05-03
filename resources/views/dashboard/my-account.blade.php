@extends('corporate::layouts.master')
@section('content')
	<x-theme-h1>
		{{__('Your account details')}}
	</x-theme-h1>
	<p class="mb-2 italic">{{__('Please note following details are strictly personal and must not be shared with other corporate members.')}}</p>
	{{ \Eutranet\Commons\Facades\EditFacade::display('corporate', 'staff-member', Auth::id()) }}
@endsection