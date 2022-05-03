@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		<div class="col-span-full">
			<x-theme-h1>{{ __('Contact attempt info') }}</x-theme-h1>
			<strong>Contact : {{ $contactAttempt->user->name ?? 'NO LEAD'  }} | Tax ID
				: {{ $contactAttempt->user->nif ?? 'NO NIF'  }} | Phone
				: {{ $contactAttempt->user->phone ?? 'NO PHONE'  }}</strong>
			<p>Trial at : {{ $contactAttempt->created_at ?? 'NO CREATION DATE' }}</p>
			<div class="my-2 p-4 border-gray-500 rounded-xl bg-gray-100">
				@if($contactAttempt->success)
					<i class="fa fa-check text-green-500"></i>
				@else
					<i class="fa fa-exclamation-circle text-red-500"></i>
				@endif
				{{ $contactAttempt->feedback->body ?? 'NO FEEDBACK' }}
			</div>
			<x-ui.back.h2 class="mt-2">{{__('Contact attempts history')}}</x-ui.back.h2>
			@forelse(\App\Models\Contacts\ContactAttempt::where('user_id', $user->id)->orderByDesc('created_at')->get() as $ca)
				<div class="col-span-full">
					<a href="{{ route('admin.users.contact-attempts.show', [$selu, $ca]) }}"
					   class="w-full p-0.5 border-b-2 border-gray-400">
						@if($ca->success)
							<i class="fa fa-check text-green-500 w-3 mr-2 inline-block"></i>
						@else
							<i class="fa fa-times text-red-500 w-3 mr-2 inline-block"></i>
						@endif
						{{ $ca->user->name }}
						| {{ $ca->created_at ? date_format($ca->created_at, 'd-m-Y') : 'NO CREATION DATE' }}
						@ {{ $ca->created_at ? date_format($ca->created_at, 'H:i:s') : 'NO CREATION TIME' }}
						| {{$ca->feedback->body ?? 'NO FEEDBACK'}}
					</a>
				</div>
			@empty
			@endforelse
		</div>
	</div>
@endsection
