@extends('corporate::layouts.master')
@section('content')
	<x-theme-h1>
		{{__('Send a message to ') . $user->name }}
	</x-theme-h1>
	<p class="mb-2 italic">{{__('Send an email to this user.') }}</p>
	@component('corporate::components.messages.form', ['user' => $user] )@endcomponent
@endsection