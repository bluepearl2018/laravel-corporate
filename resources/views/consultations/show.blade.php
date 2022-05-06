@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::consultations.actions-and-title')
		<x-theme-form-validation-errors></x-theme-form-validation-errors>
		<div class="col-span-1">
			<x-theme-h1>
				{{ __('Consultation details') }}
			</x-theme-h1>
			<p class="mb-2 italic">{{__('Schedule new consultation')}}</p>
			<form id="selected-user-consultations-update-frm"
				  action="{{route('admin.users.consultations.update', [$user, $consultation])}}"
				  method="POST">
				@csrf
				@method('PUT')
				@foreach(\Eutranet\Corporate\Models\Consultation::getFields() as $columnName => $specs)
					<div class="col-span-1 break-inside-avoid">
						<x-dynamic-component :component="'theme-form-'.$specs[0].'-'.$specs[1]"
											 :specs="$specs"
											 :old="$consultation->$columnName"
											 :columnName="$columnName">
						</x-dynamic-component>
					</div>
				@endforeach
				<input type="hidden" name="a_or_b" value="a">
				<input type="hidden" name="user_id" value="{{ $user->id }}">
				<input type="hidden" name="staff_member_id" value="{{Auth::id()}}">
				<x-theme-form-update-buttons form="selected-user-consultations-update-frm"></x-theme-form-update-buttons>
			</form>
		</div>
		<div class="col-span-1">
			<x-theme-h2>{{__('Save feedback for the consultation')}}</x-theme-h2>
			<p class="mb-2 italic">{{__('One saved, the feedback will appear in the list accessible under the bull eye icon.')}}</p>
			<form id="save-feedback-for-consultation-frm" action="{{route('admin.users.feedbacks.store', [$user])}}"
				  method="POST">
				@csrf
				<div class="bg-green-100 p-4 rounded-xl mb-4 form-item">
					<label class="flex flex-col">
						{{__('Feedback') }}
						<textarea name="body" class="form-input" rows="8"></textarea>
					</label>
				</div>
				<input type="hidden" name="feedbackable_type" value="Eutranet\Corporate\Models\Consultation">
				<input type="hidden" name="feedbackable_id" value="{{$consultation->id}}">
				<input type="hidden" name="a_or_b" value="a">
				<input type="hidden" name="user_id" value="{{ $user->id }}">
				<input type="hidden" name="staff_member_id" value="{{Auth::id()}}">
				<x-theme-form-save-buttons form="save-feedback-for-consultation-frm"></x-theme-form-save-buttons>
			</form>
		</div>
	</div>
@endsection
