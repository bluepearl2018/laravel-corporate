@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('florbela-backend::contact-attempts.actions-and-title')
		<div class="col-span-full">
			<x-theme-h1>{{__('Contact attempt')}}</x-theme-h1>
			<p>{{__('Type the feedback here while you are contacting the person...')}}</p>
		</div>
		@if($errors->any())
			<x-theme-form-validation-errors></x-theme-form-validation-errors>
		@endif
		@isset($user)
			<form id="report-contact-frm"
				action="{{route('admin.users.contact-attempts.store', ['user' => $user]) }}" method="POST">
				@csrf
				<div class="col-span-1">
					@foreach(\Eutranet\Corporate\Models\Feedback::getFields() as $columnName => $specs)
						<x-dynamic-component :component="'theme-form-'.$specs[0].'-'.$specs[1]"
											 :specs="$specs"
											 :old="old($columnName)"
											 :columnName="$columnName"
											 model="{{ $specs[5] ?? '' }}"></x-dynamic-component>
					@endforeach
				</div>
				<div class="col-span-1">
					@foreach(\Eutranet\Corporate\Models\ContactAttempt::getFields() as $columnName => $specs)
						<x-dynamic-component :component="'theme-form-'.$specs[0].'-'.$specs[1]"
											 :specs="$specs"
											 :old="old($columnName)"
											 :columnName="$columnName"
											 model="{{ $specs[5] ?? '' }}"></x-dynamic-component>
					@endforeach
				</div>
				@isset($user)
					<input type="hidden" name="user_id" value="{{ $selu->id }}" />
					<input type="hidden" name="staff_member_id" value="{{ Auth::id() }}" />
				@endisset
				<x-theme-form-save-buttons form="report-contact-frm"></x-theme-form-save-buttons>
			</form>
		@else
			{{ __('NO SELECTED USER') }}
		@endisset
	</div>
@endsection
