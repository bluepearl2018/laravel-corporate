@extends('corporate::layouts.master')
@section('content')
	<x-theme-h1>
		{{ __('Send "') . $notificationTemplate->name }} {{__('" to user.... "') . $user->name . '" ?'}}
	</x-theme-h1>
	<p class="mb-2 italic">{{ $notificationTemplate->description  }}</p>

	<div class="h-48 flex max-w-4xl rounded-lg border-gray-700 bg-gray-100">
		<div class="self-center mx-auto items-center max-w-7xl p-8">
			<p>{{__('Hello ') . $user->name }}</p>
			<p>
				{{$notificationTemplate->message }}
			</p>
			<a href="{{url($notificationTemplate->url)}}" type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
				{{$notificationTemplate->action }}
			</a>
		</div>
	</div>
@endsection