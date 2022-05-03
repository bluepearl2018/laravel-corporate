@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		<div class="col-span-full">
			<x-theme-h1>{{__('Contact attempt')}}</x-theme-h1>
			<p>{{__('Type the feedback here while you are calling...')}}</p>
		</div>
		<div class="col-span-1">
			@isset($user)
				<form id="create-contact-attempts-frm"
					  action="{{route('admin.users.contact-attempts.store', ['user' => $user]) }}" method="POST">
					@csrf
					Feedback, ContactAttempt forms
					<x-theme-form-save-buttons form="create-contact-attempts-frm"></x-theme-form-save-buttons>
				</form>
			@else
				{{ __('NO SELECTED USER') }}
			@endisset
		</div>
	</div>
@endsection
