@extends('corporate::layouts.master')
@section('content')
	@php($yesterdayDate = \Carbon\Carbon::yesterday()->format('Y-m-d'))
	@php($todayDate = \Carbon\Carbon::today()->format('Y-m-d'))
	@php($tomorrowDate = \Carbon\Carbon::tomorrow()->format('Y-m-d'))
	<div class="user-tab-content">
		@includeIf('corporate::feedbacks.actions-and-title')
		<div class="col-span-full">
			<x-theme-h1>
				{{ \Eutranet\Corporate\Models\Feedback::where('user_id', $selu->id)->get()->count() }}
				{{ __('Feedback(s) for the user with tax ID ') . $selu->nif }}
			</x-theme-h1>
			<p class="mb-2 italic">{{__('Here is the list with feedbacks for the customer.')}}</p>
			@forelse($feedbacks as $fb)
				<div>
                    <span>
                        @if(Str::is('*ContactAttempt*', $fb->feedbackable_type))
							<a href="{{ route('admin.users.contact-attempts.show', [$selu, $fb->feedbackable_id]) }}">
                                <i class="fa fa-phone @if($fb->feedbackable_type::where('id', $fb->feedbackable_id)->first()->success === true) text-green-500 @else text-red-500 @endif"></i>
                                {{ $fb->body ?? 'NO ' }}
                            </a>
						@elseif(Str::is('*Consultation*', $fb->feedbackable_type))
							<a href="{{ route('admin.users.laravel-consultations.show', [$selu, $fb->feedbackable_id]) }}">
                                <i class="fa fa-calendar-alt"></i>
                                {{ $fb->body ?? 'NO ' }}
                            </a>
						@endif
                    </span>
				</div>
			@empty
			@endforelse
		</div>
	</div>
@endsection
