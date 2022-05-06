@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::consultations.actions-and-title')
		<div class="col-span-full">
			<x-theme-h1>
				<span>{{__('Plan a consultation for')}} <strong>{{ $user->name }}</strong></span>
			</x-theme-h1>
			<p class="italic">{{__('Find the planned consultations via the user\'s profile.')}}</p>
		</div>
		@if($errors->any())
			<x-theme-form-validation-errors></x-theme-form-validation-errors>
		@endif
		<form class="col-span-full my-0 grid grid-cols-2 space-y-2 gap-4 break-inside-column-avoid" id="selected-user-consultations-create-frm"
			  action="{{route('admin.users.consultations.store', $user)}}" method="POST">
			@csrf
			@foreach(\Eutranet\Corporate\Models\Consultation::getFields() as $columnName => $specs)
				<x-dynamic-component :component="'theme-form-'.$specs[0].'-'.$specs[1]"
									 :specs="$specs"
									 :old="old($columnName)"
									 columnName="{{ $columnName }}"></x-dynamic-component>
			@endforeach
			<input type="hidden" name="a_or_b" value="a">
			<input type="hidden" name="user_id" value="{{ $user->id }}">
			<input type="hidden" name="staff_member_id" value="{{Auth::id()}}">
			<x-theme-form-save-buttons form="selected-user-consultations-create-frm"></x-theme-form-save-buttons>
		</form>
	</div>
@endsection
