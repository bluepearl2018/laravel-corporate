@extends('corporate::layouts.master')
@section('content')
	@php($yesterdayDate = \Carbon\Carbon::yesterday()->format('Y-m-d'))
	@php($todayDate = \Carbon\Carbon::today()->format('Y-m-d'))
	@php($tomorrowDate = \Carbon\Carbon::tomorrow()->format('Y-m-d'))
	<div class="px-6">
		@includeIf('corporate::feedbacks.actions-and-title')
		<div class="col-span-full">
			<x-theme-h1>
				{{ __('Feedback(s) for the user with tax ID ') . $user->nif }}
			</x-theme-h1>
			<p class="mb-2 italic">{{__('Here is the list with feedbacks for the customer.')}}</p>

			<div class="flex flex-col space-y-2 mt-4">
				@forelse($feedbacks as $fb)
					<div>
						@if(Str::is('*ContactAttempt*', $fb->feedbackable_type))
							<a href="{{ route('admin.users.contact-attempts.show', [$user, $fb->feedbackable_id]) }}">
								<i class="fa fa-phone"></i>
								{!! strip_tags($fb->body) ?? __('NO FEEDBACK') !!}
							</a>
						@elseif(Str::is('*Consultation*', $fb->feedbackable_type))
							<a href="{{ route('admin.users.consultations.show', [$user, $fb->feedbackable_id]) }}">
								<i class="fa fa-calendar-alt"></i>
								{!! strip_tags($fb->body) ?? __('NO FEEDBACK') !!}
							</a>
						@endif
					</div>
				@empty
					{{ __('NO FEEDBACK TO DISPLAY') }}
				@endforelse
			</div>
		</div>
	</div>
@endsection
