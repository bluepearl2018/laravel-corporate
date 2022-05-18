@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::contact-attempts.actions-and-title')
		<div class="col-span-full">
			<x-theme-h1>{{ __('Contact attempt info') }}</x-theme-h1>
			<strong>{{__('Contact :')}} {{ $contactAttempt->user->name ?? __('warnings.NO LEAD')  }} | {{ __('labels.Tax ID') }}
				: {{ $contactAttempt->user->nif ?? __('warnings.NO TAX ID')  }} | {{ __('labels.Phone') }}
				: {{ $contactAttempt->user->phone ?? __('warnings.NO PHONE NUMBER')  }}</strong>
			<p>{{ __('Trial at :') }} {{ $contactAttempt->created_at->format('d-m-Y @ H:i:s') ?? __('warnings.NO CREATION DATE') }}</p>
			<div class="my-2 p-4 border-gray-500 rounded-xl bg-gray-100 flex flex-row items-center">
				@if($contactAttempt->success)
					<i class="fa fa-check text-green-500 mr-2"></i>
				@else
					<i class="fa fa-exclamation-circle text-red-500 mr-2"></i>
				@endif
				{!! $contactAttempt->feedback->body ?? __('warnings.NO FEEDBACK')  !!}
			</div>
			<x-theme-h2 class="mt-2">{{__('Contact attempts history')}}</x-theme-h2>
			@forelse(\Eutranet\Corporate\Models\ContactAttempt::where('user_id', $user->id)->orderByDesc('created_at')->get() as $ca)
				<div x-data="{ feedback{{$loop->index}} : false }" class="col-span-full space-y-2 border-b border-gray-300">
					<div class="flex-row flex sm:justify-between items-center pt-2">
						<div
						   class="w-full p-0.5">
							@if($ca->success)
								<i class="fa fa-check text-green-500 w-3 mr-2 inline-block"></i>
							@else
								<i class="fa fa-times text-red-500 w-3 mr-2 inline-block"></i>
							@endif
							{{ $ca->user->name }}
							| {{ $ca->created_at ? date_format($ca->created_at, 'd-m-Y') : __('NO CREATION DATE') }}
							@ {{ $ca->created_at ? date_format($ca->created_at, 'H:i:s') : __('NO CREATION TIME') }}
						</div>
						@if(isset($ca->feedback) && !empty($ca->feedback->body))
							<button class="w-8 sm:w-auto btn-primary my-0 px-0.5 py-0" @click="feedback{{$loop->index}} = ! feedback{{$loop->index}}">
								<span class="visible sm:hidden"><i class="fa fa-plus"></i></span>
								<span class="hidden sm:block">{{__('labels.Feedback')}}</span>
							</button>
						@else
							{{ __('warnings.NO FEEDBACK') }}
						@endif
					</div>
					@if(isset($ca->feedback) && !empty($ca->feedback->body))
						<div x-show="feedback{{$loop->index}}" class="px-2 bg-gray-300 rounded">
							<span class="block truncate">
								{!! strip_tags($ca->feedback->body) ?? __('warnings.NO FEEDBACK')  !!}
							</span>
						</div>
					@endif
				</div>
			@empty
			@endforelse
		</div>
	</div>
@endsection
