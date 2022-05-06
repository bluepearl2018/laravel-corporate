<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
@component('theme::components.seo-meta')@endcomponent
<body class="h-full font-sans antialiased">
<div x-data="{ sidebarOpen: false, toggle() { this.sidebarOpen = ! this.sidebarOpen } }"
	 class="min-h-full max-w-7xl mx-auto">
	<!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
	<div
			x-show="sidebarOpen"
			class="fixed inset-0 flex z-40 lg:hidden" role="dialog"
			aria-modal="true">

		<div
				x-show="sidebarOpen"
				x-transition:enter="transition-opacity ease-in duration-800"
				x-transition:enter-start="opacity-100"
				x-transition:enter-end="opacity-0"
				x-transition:leave="transition-opacity ease-out duration-800 transform"
				x-transition:leave-start="opacity-0"
				x-transition:leave-end="opacity-100"
				class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>

		<div
				x-show="sidebarOpen"
				x-transition:enter="transition ease-in duration-800"
				x-transition:enter-start="-translate-x-0"
				x-transition:enter-end="translate-x-full"
				x-transition:leave="transition ease-out duration-800"
				x-transition:leave-start="translate-x-full"
				x-transition:leave-end="-translate-x-0"
				class="relative flex-1 z-40 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">

			<div
					x-show="sidebarOpen"
					x-transition:enter="transition ease-in duration-300 transform"
					x-transition:enter-start="opacity-100 scale-95"
					x-transition:enter-end="opacity-0 scale-100"
					x-transition:leave="transition ease-out duration-1000 transform"
					x-transition:leave-start="opacity-0 scale-100"
					x-transition:leave-end="opacity-100 scale-95"
					class="absolute z-auto top-0 right-0 -mr-12 pt-2">
				{{-- Close sidebar button --}}
				<button
						type="button"
						@click="sidebarOpen = !sidebarOpen"
						class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
					<span class="sr-only">{{__('Close sidebar')}}</span>
					<i class="fa fa-times-circle fa-2x mt-2 mr-2 text-gray-200"></i>
				</button>
			</div>

			<div class="flex-shrink-0 flex items-center px-4">
				{{-- Logo --}}
				<a href="{{ route('admin.back') }}">
					<img class="h-8 w-auto" src="{{ asset('images/logo.svg') }}"
						 alt="{{ config('eutranet-corporate.name') }}"/>
				</a>
			</div>
			<div class="mt-5 flex-1 h-0 overflow-y-auto">
				<nav class="px-2">
					<div class="space-y-1">
						<a href="{{ route('admin.back') }}"
						   class="@if(Route::is('admin.back'))
								   bg-gray-100 text-gray-900 hover:text-gray-900 hover:bg-gray-50 bg-gray-100
								   text-gray-900 group flex items-center px-2 py-2 text-base leading-5
								   font-medium rounded-md
									@else
								   text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5
								   font-medium rounded-md
								@endif" aria-current="page">
							<i class="fa fa-home mr-3 text-gray-400 text-xl"></i>
							<span>{{ __('Back office') }}</span>
						</a>

						<a href="{{ route('backend.users.index') }}"
						   class="@if(Route::is('admin.users.*'))
								   bg-gray-100 text-gray-900 hover:text-gray-900 hover:bg-gray-50 bg-gray-100
								   text-gray-900 group flex items-center px-2 py-2 text-base leading-5
								   font-medium rounded-md
								@else
								   text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5
								   font-medium rounded-md
								@endif">
							<i class="fa fa-users mr-3 text-gray-400 text-xl"></i>
							{{ __('Users') }}
						</a>
					</div>
				</nav>
			</div>
		</div>

		<div class="flex-shrink-0 w-14" aria-hidden="true">
			<!-- Dummy element to force sidebar to shrink to fit close icon -->
		</div>
	</div>

	<!-- Static sidebar for desktop -->
	<div
			class="hidden z-40 lg:flex lg:flex-col lg:w-96 lg:fixed lg:inset-y-0 lg:border-r lg:border-gray-200 lg:pt-5 lg:pb-4 lg:bg-gray-100">
		{{--Logo--}}
		<div class="flex items-center flex-shrink-0 px-6">
			<a href="{{ route('admin.dashboard') }}">
				<img class="h-16 w-auto" src="{{ asset('images/logo.svg') }}"
					 alt="{{ config('eutranet-corporate.name') }}"/>
			</a>
		</div>
		{{-- Sidebar component, swap this element with another sidebar if you like --}}
		<div class="h-0 flex-1 flex flex-col overflow-y-auto">
			<!-- Navigation -->
			<nav class="mx-6 sm:px-0 mt-6">
				<div class="xl:order-2 relative">
					@auth('staff')
						<nav class="space-y-1" aria-label="Sidebar">
							<div class="flex flex-row items-center @if(Route::is('admin.dashboard')) bg-gray-200 text-gray-900 @endif px-3 py-2 text-sm font-medium rounded-md">
								<a href="{{ route('admin.dashboard') }}" class="w-full" aria-current="page">
									<i class="fa fa-home text-gray-400 text-xl mr-3"></i>
									<span class="truncate"> {{__('Corporate dashboard')}} </span>
									<!-- Current: "bg-gray-50", Default: "bg-gray-200 text-gray-600" -->
								</a>
								<a class="@if(Route::is('admin.dashboard')) bg-gray-50 @else bg-gray-200 text-gray-600 @endif ml-auto inline-block py-0.5 px-3 text-xs rounded-full" href="{{route('backend.users.index', ['filter' => 'contact']) }}">
									{{ \App\Models\User::where('user_status_id', '<', 2)->get()->count() }}
								</a>
							</div>
							@if(Route::has('backend.dashboard'))
								<div class="flex flex-row items-center @if(Route::is('backend.dashboard')) bg-gray-200 text-gray-900 @endif px-3 py-2 text-sm font-medium rounded-md">
									<a href="{{ route('backend.dashboard') }}" class="w-full" aria-current="page">
										<i class="fa fa-user-friends text-gray-400 text-xl mr-3"></i>
										<span class="truncate"> {{__('Backend dashboard')}} </span>
										<!-- Current: "bg-gray-50", Default: "bg-gray-200 text-gray-600" -->
									</a>
								</div>
							@endif
							<a href="{{ route('admin.staff-members.index') }}"
							   class="@if(Route::is('admin.staff-members.index')) bg-gray-200 text-gray-900 @endif text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
								<i class="fa fa-users-cog text-gray-400 text-xl mr-3"></i>
								<span class="truncate">{{ __('Staff members') }}</span>
							</a>
							@if(Auth::user()->hasRole('super-staff'))
								<li>
									<a href="{{ route('admin.corporate-agreements.index') }}">{{__('Corporate agreements')}}</a>
								</li>
							@endif
							<a href="{{ route('admin.users.index') }}"
							   class="@if(Route::is('admin.users.index')) bg-gray-200 text-gray-900 @endif text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
								<i class="fa fa-users text-gray-400 text-xl mr-3"></i>
								<span class="truncate">{{ __('Accounts') }}</span>
							</a>
							@role('super-staff')
								<a href="{{ route('admin.corporates.show', 1) }}"
								   class="@if(Route::is('admin.corporates.show')) bg-gray-200 text-gray-900 @endif text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
									<i class="fa fa-list text-gray-400 text-xl mr-3"></i>
									<span class="truncate">{{ __('Corporate details') }}</span>
								</a>
							@endrole
							<a href="{{ route('admin.agreements.index') }}"
							   class="@if(Route::is('admin.agreements.index')) bg-gray-200 text-gray-900 @endif text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
								<i class="fa fa-file-signature text-gray-400 text-xl mr-3"></i>
								<span class="truncate">{{ __('Agreements') }}</span>
							</a>
							<a href="{{ route('admin.corporate-agreements.index') }}"
							   class="@if(Route::is('admin.corporate-agreements.index')) bg-gray-200 text-gray-900 @endif text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
								<i class="fa fa-file-signature text-gray-400 text-xl mr-3"></i>
								<span class="truncate">{{ __('Corporate agreements') }}</span>
							</a>
							<a href="{{ route('admin.corporate-general-terms.index') }}"
							   class="@if(Route::is('admin.corporate-general-terms.index')) bg-gray-200 text-gray-900 @endif text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
								<i class="fa fa-file-signature text-gray-400 text-xl mr-3"></i>
								<span class="truncate">{{ __('Corporate general terms') }}</span>
							</a>
						</nav>
					@endauth
					{{-- Filters --}}
					<x-theme-h2 class="mt-4">{{__('Filter users by status... and more')}}</x-theme-h2>
					<ul class="list-inside">
						@forelse(\Eutranet\Commons\Models\UserStatus::all() as $uSt)
							<li>
								<a href="{{ route('admin.users.filter-by-status', ['user_status' => $uSt]) }}">{{ $uSt->name }}</a>
							</li>
						@empty
							<li>{{__('No status filters available')}}</li>
						@endforelse
						<li>
							{{-- Find User by Phone number  --}}
							<form action="{{ route('admin.users.find-by-phone-number') }}" id="search-for-phone-number-frm"
								  class="block w-full h-full flex py-2 border-transparent text-gray-900
									  placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent
									  focus:placeholder-gray-400 sm:text-sm"
								  method="POST">
								@csrf
								<label for="phone-number-search-input">@if($errors->any && $errors->has('nif'))
										<span class="text-xs text-red-500">***</span>
									@endif</label>
								<input id="phone-number-search-input" name="phone" type="text" placeholder="{{ __('Enter the phone number') }}" required
									   class="max-w-xs mr-2 text-lg py-1 tracking-wide shadow-sm focus:ring-2 focus:ring-offset-0 focus:ring-yellow-500 block w-full sm:text-sm border-yellow-300 rounded-md"
									   minlength="9" maxlength="16"/>
								<button type="submit" form="search-for-phone-number-frm" class="inline-block w-12"><i
											class="fa fa-search self-center text-yellow-500"></i></button>
							</form>
						</li>
					</ul>
					<x-theme-h2 class="mt-4">{{__('Core business')}}</x-theme-h2>
					<ul class="list-inside">
						<li>
							<a href="{{ route('admin.users.create') }}">{{__('Register a new user')}}</a>
						</li>
						@isset($selu)
							<li>
								<a href="{{ route('admin.user-payments.index', [$selu]) }}">{{__('Manage user payment')}}</a>
							</li>
						@endif
					</ul>
					{{-- Core businesss nav bar--}}
					<div class="flex flex-col">
						@yield('core-business-menu')
					</div>
				</div>
			</nav>
		</div>
	</div>

	<!-- Main column -->
	<div class="lg:pl-96 flex flex-col relative">
		<!-- Search header -->
		<div
				class="top-0 z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200">
			<!-- Sidebar toggle, controls the 'sidebarOpen' sidebar state. -->
			<button
					@click="sidebarOpen = !sidebarOpen"
					type="button"
					class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 lg:hidden">
				<span class="sr-only">{{__('Open sidebar')}}</span>
				<i class="fa fa-bars"></i>
			</button>
			{{-- Search and Profile--}}
			<div class="flex-1 theme-bg flex justify-between px-4 sm:px-6 lg:px-8">
				{{-- Search --}}
				<div class="flex-1 flex">
					{{-- Find User by TAX ID (NIF)  --}}
					<form action="{{ route('admin.users.find-by-nif') }}" id="search-for-nif-frm"
						  class="block w-full h-full flex items-center py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent focus:placeholder-gray-400 sm:text-sm"
						  method="POST">
						@csrf
						<label for="nif">@if($errors->any && $errors->has('nif'))
								<span class="text-xs text-red-500">***</span>
							@endif</label>
						<input id="nif" name="nif" type="text" placeholder="{{ __('Search by Tax ID') }}" required
							   class="max-w-xs ml-4 mr-2 text-lg py-1 tracking-wide shadow-sm focus:ring-2 focus:ring-offset-0 focus:ring-yellow-500 block w-full sm:text-sm border-yellow-300 rounded-md"
							   minlength="9" maxlength="9"/>
						<button type="submit" form="search-for-nif-frm" class="inline-block w-12"><i
									class="fa fa-search self-center text-yellow-500"></i></button>
					</form>
				</div>
				@auth
					{{-- Logged In user Menu --}}
					<div class="flex items-center">
						<!-- Profile dropdown -->
						<div x-data="{ profileMenu: false }" class="ml-3">
							<div>
								<button
										@click="profileMenu = !profileMenu"
										type="button"
										class="max-w-xs flex rounded-lg items-center
										px-4 py-2 text-sm rounded-md border-gray-400
										text-gray-600 focus:outline-none focus:ring-2
										focus:ring-offset-0 focus:ring-yellow-500 bg-gray-50"
										id="user-menu-button" aria-expanded="false" aria-haspopup="true">
									<span class="sr-only">{{__('Open user menu')}}</span>
									{{ Auth::user()->name }}
								</button>
							</div>
							<div
									x-show="profileMenu"
									x-transition:enter="transition ease-out duration-100 transform"
									x-transition:enter-start="opacity-0 scale-95"
									x-transition:enter-end="opacity-100 scale-100"
									x-transition:leave="transition ease-in duration-75 transform"
									x-transition:leave-start="opacity-100 scale-100"
									x-transition:leave-end="opacity-0 scale-95"
									class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 focus:outline-none"
									role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
									tabindex="-1">
								<div class="py-1" role="none">
									<!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
									@if(Route::has('admin.my-account'))
										<a href="{{ route('admin.staff-members.show', Auth::id()) }}"
										   class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
										   id="user-menu-item-0">{{__('My account')}}</a>
									@endif
									@if(Route::has('admin.staff-members.users.index'))
										<a href="{{ route('admin.staff-members.users.index', Auth::user()) }}"
										   class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
										   id="user-menu-item-1">{{__('My portfolio')}}</a>
									@endif
									@if(Route::has('admin.staff-members.messages.history'))
										<a href="{{ route('admin.staff-members.messages.history', Auth::user()) }}"
										   class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
										   id="user-menu-item-2">{{__('My messages')}}</a>
									@endif
									@if(Route::has('admin.staff-members.consultations.index'))
										<a href="{{ route('admin.staff-members.consultations.index', Auth::user()) }}"
										   class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
										   id="user-menu-item-2">{{__('My agenda')}}</a>
									@endif
								</div>
								<div class="py-1" role="none">
									<form id="logout-frm"
										  action="{{ route('logout')}}"
										  method="POST">
										@csrf
										<button form="logout-frm" class="text-gray-700 block px-4 py-2 text-sm"
												role="menuitem" tabindex="-1"
												id="user-menu-item-5">{{__('Logout')}}</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				@endauth
			</div>
		</div>
		{{-- MAIN BLOCK --}}
		<main class="flex-1">
			<x-theme-flash-message></x-theme-flash-message>
			<div class="p-4">
				@yield('content')
			</div>
			@component('theme::partials.footer', ['model' => 'EutranetCorporateModelsCorporate'])@endcomponent
		</main>
	</div>
</div>
@stack('bottom-scripts')
</body>
</html>
