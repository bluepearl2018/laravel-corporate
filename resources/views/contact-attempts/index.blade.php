@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		<div class="col-span-full">
			<x-theme-h1>{{ __('Contact attempts') }}</x-theme-h1>
			@forelse($contactAttempts->sortByDesc('created_at') as $contactAttempt)
				<a class="w-full inline-block"
				   href="{{ route('admin.users.contact-attempts.show', [$contactAttempt->user, $contactAttempt]) }}">
					{{ $contactAttempt->feedback->body ?? 'NO FEEDBACK' }}
				</a>
			@empty
			@endforelse
		</div>
	</div>
@endsection
