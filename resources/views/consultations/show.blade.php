@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::consultations.actions-and-title')
		<x-theme-form-validation-errors></x-theme-form-validation-errors>
		<div class="col-span-1 bg-gray-100 rounded p-4">
			<x-theme-h1>
				{{ __('Consultation for ') }} {{$user->name}}
			</x-theme-h1>
			@forelse(collect($consultation->getFields()) as $key => $field)
				<div class="w-full flex-col flex rounded py-1 border-b border-gray-300">
					<div class="w-1/3 font-semibold">
						{{ $field[3] }}
					</div>
					@if($field[0] === 'select')
						<div>{!! $field[5]::where('id', $consultation->$key)->get()->first() ? $field[5]::where('id', $consultation->$key)->get()->first()->name : '<i class="fa fa-times text-red-500"></i>' !!} </div>
					@else
						<div>{!! $consultation->$key ?: '<i class="fa fa-times text-red-500"></i>' !!} </div>
					@endif
				</div>
			@empty
			@endforelse
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
