@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		<x-theme-h1>
			<span>{{__('New consultation for')}} <strong>{{ $selu->userInfos->first()->first_name }} {{ $selu->userInfos->first()->last_name }}</strong> ({{ $selu->name }})</span>
		</x-theme-h1>
		<p class="mb-2 italic">{{__('Schedeule new consultation')}}</p>
		<x-forms.validation-errors></x-forms.validation-errors>
		<form id="selected-user-consultations-create-frm"
			  action="{{route('admin.users.laravel-consultations.store', $selu)}}" method="POST">
			@csrf
			@foreach(\App\Models\Staff\Consultation::getFields() as $columnName => $specs)
				<div class="col-span-1">
					<x-dynamic-component :component="'theme-form-'.$specs[0].'-'.$specs[1]"
										 :specs="$specs"
										 :old="old($columnName)"
										 columnName="{{ $columnName }}"></x-dynamic-component>
				</div>
			@endforeach
			<input type="hidden" name="a_or_b" value="a">
			<input type="hidden" name="user_id" value="{{ $selu->id }}">
			<input type="hidden" name="staff_id" value="{{Auth::id()}}">
			<x-forms.save-buttons form="selected-user-consultations-create-frm"></x-forms.save-buttons>
		</form>
	</div>
@endsection
