@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::contact-attempts.actions-and-title')
		<div class="col-span-full">
			<x-theme-h1 class="mt-2">{{__('Contact attempts log')}}</x-theme-h1>
			<p class="mb-2">{{__('All contact attempts, for all users.')}}</p>
		</div>
		<div class="col-span-full">
		@forelse(\Eutranet\Corporate\Models\ContactAttempt::orderByDesc('created_at')->get() as $ca)
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
						| {{ $ca->created_at ? date_format($ca->created_at, 'd-m-Y') : 'NO CREATION DATE' }}
						@ {{ $ca->created_at ? date_format($ca->created_at, 'H:i:s') : 'NO CREATION TIME' }}
					</div>
					@if(isset($ca->feedback) && !empty($ca->feedback->body))
						<button class="w-8 sm:w-auto btn-primary my-0 px-0.5 py-0" @click="feedback{{$loop->index}} = ! feedback{{$loop->index}}">
							<span class="visible sm:hidden"><i class="fa fa-plus"></i></span>
							<span class="hidden sm:block">{{__('Feedback')}}</span>
						</button>
					@else
						{{ __('No feedback') }}
					@endif
				</div>
				@if(isset($ca->feedback) && !empty($ca->feedback->body))
					<div x-show="feedback{{$loop->index}}" class="px-2 bg-gray-300 rounded">
						<span class="block truncate">
							{!! strip_tags($ca->feedback->body) ?? 'NO FEEDBACK'  !!}
						</span>
					</div>
				@endif
			</div>
		@empty
		@endforelse
		</div>
	</div>
@endsection
