@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::consultations.actions-and-title')
		<div class="col-span-full">
			@php($yesterdayDate = \Carbon\Carbon::yesterday()->format('Y-m-d'))
			@php($todayDate = \Carbon\Carbon::today()->format('Y-m-d'))
			@php($tomorrowDate = \Carbon\Carbon::tomorrow()->format('Y-m-d'))
			<x-theme-h1
					class="text-2xl mr-2 uppercase">{{ \Eutranet\Corporate\Models\Consultation::count() }} {{__('consultation(s)')}}
				<span class="text-base">
                    <a href="{{ route('admin.users.consultations.index', $user) }}">
                        (<span>{{ __('Display all for') }} {{ $user->name }} | </span>
                    </a>
                    <a class="bg-yellow-200 px-1"
					   href="{{ route('admin.users.consultations.index', [$user, 'filter' => $todayDate]) }}">{{ \Eutranet\Corporate\Models\Consultation::where('booked_on', $todayDate)->count() }}
                        <span class="text-base">{{ __('today') }}</span>
                    </a>)
                </span>
			</x-theme-h1>
			<p class="mb-2 italic">{{ __('The list of all laravel-consultations planned for the current logged staff member. In other words, this is a kind of agenda.') }}</p>

			@isset($consultations)
				{{-- FILTERS --}}
				<div class="font-semibold flex flex-row space-x-2 w-full items-center my-2 pb-1 border-yellow-500 border-b-2 justify-between">
					<div class="flex flex-row space-x-2">
						<span><i class="fa fa-calendar-alt"></i></span>
						<a href="{{ route('admin.users.consultations.index',  [$user, 'filter='.$yesterdayDate]) }}">
                            <span class="uppercase inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium font-bold
                                @if(Request::get('filter') == $yesterdayDate) bg-yellow-500 text-gray-700 @else bg-gray-100 text-gray-800 @endif">
                                {{ __('yesterday') }}
                            </span>
						</a>
						<a href="{{ route('admin.users.consultations.index', [$user, 'filter='.$todayDate]) }}">
                            <span class="uppercase inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium font-bold
                                @if(Request::get('filter') == $todayDate) bg-yellow-500 text-gray-700 @else bg-gray-100 text-gray-800 @endif">
                                {{ __('today') }}
                            </span>
						</a>
						<a href="{{ route('admin.users.consultations.index', [$user, 'filter='.$tomorrowDate]) }}">
                            <span class="uppercase inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium font-bold
                                @if(Request::get('filter') == $tomorrowDate) bg-yellow-500 text-gray-700 @else bg-gray-100 text-gray-800 @endif">
                                {{ __('tomorrow') }}
                            </span>
						</a>
					</div>
					<div class="flex flex-row">
						<a href="{{ route('admin.users.consultations.create', $user) }}" class="btn-primary"><i
									class="fa fa-plus"></i></a>
					</div>
				</div>
				<div class="col-span-1 p-0">
					@forelse($consultations as $consultation)
						<div>
							@if($consultation->staff->_id == Auth::id())
								<i class="fa fa-arrow-right text-yellow-600 bg-yellow-100 p-0.5 mr-2"></i>
							@else
								<i class="fa fa-arrow-right text-gray-500 mr-2"></i>
							@endif
							<a href="{{ route('admin.users.consultations.show', [$user, $consultation]) }}">{{$consultation->user->name }}
								| {{ $consultation->agency->code ?? 'NOT ASSIGNED' }}
								| {{ $consultation->staffMember->name ?? 'NOT ASSIGNED' }} | {{ $consultation->booked_on }}
								| {{ $consultation->booked_at }}</a>
						</div>
					@empty
						{{__('NO CONSULTATION TO DISPLAY')}}
					@endforelse

					@unless($user || $url = Str::contains(Request::fullUrl(), 'filter'))
						{{ $consultations->links()  }}
					@endunless
					@else
						<a class="btn-primary" href="{{route('admin.users.consultations.create', $user)}}">
							{{__('Book a consultation')}}
						</a>
					@endisset
				</div>
		</div>
	</div>
@endsection


{{-- Start Task Sections --}}
@section('today')
	@isset($consultations['today'])
		<h3><i class="ion ion-speakerphone"></i> Today:</h3>
		<div class="consultations">
			@forelse ($consultations['today'] as $consultation)
				{{$consultation}}
			@empty
				{{__('NO CONSULTATION TO DISPLAY')}}
			@endforelse
		</div>
	@endif
@endsection

@section('tomorrow')
	@isset($consultations['tomorrow'])
		<h3><i class="ion ion-paper-airplane"></i> Tomorrow:</h3>
		<div class="consultations">
			@forelse($consultations['tomorrow'] as $consultation)
				{{$consultation}}
			@empty
				{{__('NO CONSULTATION TO DISPLAY')}}
			@endforelse
		</div>
	@endif
@endsection


@section('coming')
	@isset($consultations['coming'])
		<h3><i class="ion ion-flag"></i> Coming:</h3>
		<div class="consultations">
			@forelse ($consultations['coming'] as $consultation)
				{{$consultation}}
			@empty
				{{__('NO CONSULTATION TO DISPLAY')}}
			@endforelse
		</div>
	@endif
@endsection

@section('overdue')
	@isset($consultations['overdue'])
		<h3><i class="ion ion-filing"></i> Overdue:</h3>
		<div class="consultations">
			@forelse ($consultations['overdue'] as $consultation)
				{{$consultation}}
			@empty
				{{__('NO CONSULTATION TO DISPLAY')}}
			@endforelse
		</div>
	@endif
@endsection
