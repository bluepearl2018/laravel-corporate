@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::consultations.actions-and-title')
		<x-theme-form-validation-errors></x-theme-form-validation-errors>
		<div class="col-span-1">
			<x-theme-h1>
				{{ __('Edit consultation') }}
			</x-theme-h1>
			<p class="mb-2 italic">{{__('Modify consultation')}}</p>
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
	</div>
@endsection
