@extends('corporate::layouts.master')
@section('content')
	<x-theme-h1>{{ __('A nossa equipa') }}</x-theme-h1>
	<p class="mb-2 italic">{{__('Staff members stay hidden until staff member profile was completed')}}</p>
	<p class="mb-2 italic">{{ $corporate->getClassLead() }}</p>
	<div class="bg-white mt-8">
		<div class="mx-auto max-w-7xl">
			<div class="space-y-12 lg:grid lg:grid-cols-3 lg:gap-8 lg:space-y-0">
				<div class="lg:col-span-3 col-start-1">
					<ul role="list"
						class="space-y-12 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:gap-y-8 sm:space-y-0 lg:gap-x-8">
						@forelse($staffMembers as $staffMember)
							@if($staffMember->first_name !== NULL && $staffMember->last_name !== NULL && $staffMember->function !== NULL)
							<li>
								<div class="border shadow-lg rounded-xl">
									@if($staffMember->getFirstMediaUrl('staff-members'))
									<div class="aspect-w-3 aspect-h-2">
										<img class="object-cover grayscale"
											 src="{{ $staffMember->getFirstMediaUrl('staff-members') }}"
											 alt="{{ $staffMember->first_name }} {{ $staffMember->last_name }}, {{ $staffMember->function }}"/>
									</div>
									@endif
									<div class="text-lg leading-6 font-medium space-y-1 border-b">
										<h3 class="text-3xl theme-bg px-4 py-2 tracking-wide text-yellow-600 text-right font-extrabold">{{ $staffMember->first_name.' '.$staffMember->last_name }}</h3>
										<p class="text-yellow-800 px-2 py-1 text-right font-extrabold">{{ $staffMember->function ?? '' }}</p>
									</div>
									<div class="text-lg p-8">
										<p class="text-gray-800 mb-4">{{ $staffMember->lead }}</p>
										<a class="inline-block text-right w-full"
										   href="{{ route('admin.staff-members.show', $staffMember) }}">{{ __('More ') }}
											<i class="fa fa-arrow-right"></i></a>
									</div>
									<div class="relative z-0 shadow-sm rounded-md w-full grid-cols-3 grid">
										<form id="staff-email-frm-{{$loop->index}}" action="{{route('admin.email-staff', $staffMember)}}" method="post" class="relative items-center text-center inline-flex sm:col-span-1
										items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white
										text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10
										focus:outline-none focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500">
										  @csrf
										  <button form="staff-email-frm-{{$loop->index}}" type="submit" class="w-full">
											  <i class="fa fa-envelope inline-block w-8 mx-auto"></i>
										  </button>
										</form>
										<form id="staff-call-frm-{{$loop->index}}" action="{{route('admin.call-staff', $staffMember)}}" method="post" class="relative items-center text-center inline-flex sm:col-span-1
										items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white
										text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10
										focus:outline-none focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500">
											@csrf
											<button form="staff-call-frm-{{$loop->index}}" type="submit" class="w-full">
												<i class="fa fa-phone inline-block w-8 mx-auto"></i>
											</button>
										</form>
										<form id="staff-notify-frm-{{$loop->index}}" action="{{route('admin.notify-staff-member', $staffMember)}}" method="post" class="relative items-center text-center inline-flex sm:col-span-1
										items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white
										text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10
										focus:outline-none focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500">
											@csrf
											<button form="staff-notify-frm-{{$loop->index}}" type="submit" class="w-full">
												<i class="fa fa-bell inline-block w-8 mx-auto"></i>
											</button>
										</form>
									</div>

										<ul role="list" class="flex space-x-5">
										@isset($staffMember->twitter)
											<li>
												<a href="#" class="text-gray-400 hover:text-gray-500">
													<span class="sr-only">Twitter</span>
													<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
														 aria-hidden="true">
														<path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
													</svg>
												</a>
											</li>
										@endisset
										@isset($staffMember->linkedin)
											<li>
												<a href="#" class="text-gray-400 hover:text-gray-500">
													<span class="sr-only">LinkedIn</span>
													<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
														 aria-hidden="true">
														<path fill-rule="evenodd"
															  d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z"
															  clip-rule="evenodd"/>
													</svg>
												</a>
											</li>
										@endisset
									</ul>
								</div>
							</li>
							@endif
						@empty
							{{__('NOTHING TO SHOW')}}
						@endforelse
					</ul>
					@if($staffMembers instanceof \Illuminate\Pagination\LengthAwarePaginator )
						<div class="w-full p-3 block">
							{{ $staffMembers->links() }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection
