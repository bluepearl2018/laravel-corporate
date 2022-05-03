@extends('corporate::layouts.master')
@section('content')
	<x-theme-h1>
		{{__('Send a notification to ') . $user->name }}
	</x-theme-h1>
	<p class="mb-2 italic">{{__('Select one or several user-notifications to send...') }}</p>
	<div class="py-4 flex flex-wrap gap-4">
		@forelse(\Eutranet\Corporate\Models\NotificationTemplate::where('is_active', true)->get() as $notificationTemplate)
			<form id="{{$loop->index}}-notif-template-form" action="{{ route('admin.view-notification-template', [$notificationTemplate, $user]) }}" method="post">
				@csrf
				<button id="{{$loop->index}}-notif-template-form" type="submit" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500">
					{{$notificationTemplate->name}}
				</button>
			</form>
			@empty
		@endforelse
	</div>
@endsection