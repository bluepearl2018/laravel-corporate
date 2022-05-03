@extends('corporate::layouts.master')
@section('content')
	<div class="relative bg-white mt-6">
		@if($staffMember->getFirstMediaUrl('staff-members'))
		<div class="lg:absolute lg:inset-0">
			<div class="lg:absolute lg:inset-y-0 lg:left-0 lg:w-1/3">
				<img class="h-56 w-full object-cover lg:absolute lg:h-full grayscale"
					 src="{{ $staffMember->getFirstMediaUrl('staff-members') }}"
					 alt="{{ $staffMember->first_name }} {{ $staffMember->last_name }}">
			</div>
		</div>
		@endif
		<div class="relative pt-12 pb-16 px-4 sm:pt-16 sm:px-6 lg:px-8 lg:pt-8
		lg:max-w-7xl lg:mx-auto lg:grid lg:grid-cols-3">
			<div class="absolute top-1 right-1"><a href="{{route('admin.staff-members.edit', Auth::id())}}"><i class="fa fa-edit w-8 h-8"></i></a></div>
			<div class="lg:col-start-2 lg:col-span-2 lg:pl-8 relative">
				<div class="text-base max-w-prose mx-auto lg:max-w-lg lg:ml-auto lg:mr-0">
					<x-theme-h2
							class="leading-6 text-yellow-600 font-extrabold tracking-wide uppercase text-lg">{{ $staffMember->function }}
					</x-theme-h2>
					<h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-5xl">{{ $staffMember->first_name }} {{ $staffMember->last_name }}</h3>
					<p class="mt-4 text-lg text-gray-500">{{ $staffMember->lead  }}</p>
					<div class="mt-5 prose prose-yellow text-gray-500">
						{{ $staffMember->body }}
					</div>
					@component('corporate::components.roles-and-permissions.list', ['user' => $staffMember])@endcomponent
				</div>
			</div>
		</div>

	</div>
@endsection
