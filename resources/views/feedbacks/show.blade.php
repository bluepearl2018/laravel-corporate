@extends('layouts.back.users')
@section('content')
	<x-theme-h1>{{__('Feedback details')}}</x-theme-h1>
	<div class="grid grid-cols-3">
		<div class="col-span-2">
			@forelse($selu->feedbacks as $fb)
				<div>
                    <span>
                        @if(Str::is('*ContactAttempt*', $fb->feedbackable_type))
							<i class="fa fa-phone @if($fb->feedbackable_type::where('id', $fb->feedbackable_id)->first()->success === true) text-green-500 @endif"></i>
						@elseif(Str::is('*Consultation*', $fb->feedbackable_type))
							<i class="fa fa-agenda"></i>
						@endif
                    </span>
					{{ $fb->body ?? 'NO ' }}
				</div>
			@empty
			@endforelse
		</div>
	</div>
@endsection
