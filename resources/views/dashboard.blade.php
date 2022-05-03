@extends('corporate::layouts.master')
@section('content')
	<x-theme-h1>
		{{__('Hello ') . Auth::user()->name }}
	</x-theme-h1>
	<p class="mb-2 italic">{{__('This is where you will find the most urgent actions.')}}</p>
	<div class="sm:hidden">
		<label for="staff-tabs" class="sr-only">{{__('Select an option')}}</label>
		<select onchange="getStaffSelection()" id="staff-tabs" class="block w-full rounded-md border-gray-300 text-base
		font-medium text-gray-900 shadow-sm focus:border-rose-500 focus:ring-rose-500">
			<option value="staff-1" selected="">{{__('New registrations')}}</option>
			<option value="staff-2" >{{__('Messages')}}</option>
			<option value="staff-3" >{{__('Tasks')}}</option>
		</select>
		@push('bottom-scripts')
			<script>
				function getStaffSelection()
                {
                    let tabs = document.getElementById('staff-tabs');
                    if(tabs.value === 'staff-1') {
                        console.log('staff-1');
                    } else if(tabs.value === 'staff-2')  {
                        console.log('staff-2');
                    } else if(tabs.value === 'staff-3') {
                        console.log('staff-3');
                    }
				}
			</script>
		@endpush
	</div>

	<div class="text-gray-800 font-sans mx-auto max-w-4xl leading-normal">
		<div class="mt-4" x-data="{ tab: 'new-registrations' }" >
			<div class="flex w-full">
				<button
						:class="{ 'active font-bold bg-gray-100 text-gray-700': tab === 'new-registrations' }"
						class="p-3 sm:px-6 lg:px-8 focus:outline-none focus:bg-gray-50 focus:text-gray-700 hover:bg-gray-50 hover:text-gray-700 rounded-t-sm"
						@click="tab = 'new-registrations'">
					{{__('New registrations')}}
				</button>
				<button
						:class="{ 'active font-bold bg-gray-100 text-gray-700': tab === 'messages' }"
						class="p-3 sm:px-6 lg:px-8 focus:outline-none focus:bg-gray-50 focus:text-gray-700 hover:bg-gray-50 hover:text-gray-700 rounded-t-sm"
						@click="tab = 'messages'">
					{{__('Messages')}}
				</button>
				<button
						:class="{ 'active font-bold bg-gray-100 text-gray-700': tab === 'tasks' }"
						class="p-3 sm:px-6 lg:px-8 focus:outline-none focus:bg-gray-50 focus:text-gray-700 hover:bg-gray-50 hover:text-gray-700 rounded-t-sm"
						@click="tab = 'tasks'">
					{{__('tasks')}}
				</button>
			</div>

			<div class="bg-gray-100 text-gray-700 py-3 rounded-b-sm">
				<div x-show="tab === 'new-registrations'">
					<div class="mt-3">
						<!-- This example requires Tailwind CSS v2.0+ -->
						<div class="px-4 sm:px-6 lg:px-8">
							<div class="sm:flex sm:items-center">
								<div class="sm:flex-auto">
									<h1 class="text-xl font-semibold text-gray-900">
										{{__('Last registrations')}}
									</h1>
									<p class="mt-2 text-sm text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
								</div>
								<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
									<a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-yellow-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:w-auto">
										{{__('Register a contact')}}
									</a>
								</div>
							</div>
							<div class="mb-8 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
								<table class="min-w-full divide-y divide-gray-300">
									<thead class="bg-gray-50">
									<tr>
										<th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
										<th scope="col" class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
										<th scope="col" class="hidden lg:table-cell px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
										<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
											<span class="sr-only">Edit</span>
										</th>
									</tr>
									</thead>
									<tbody class="divide-y divide-gray-200 bg-white">
									@forelse(\Eutranet\Corporate\Models\User::get()->sortByDesc('created_at') as $user)
										<tr>
											<td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
												<strong>{{$user->name}}</strong>
												<dl class="font-normal">
													<dt class="sr-only sm:hidden">Status</dt>
													<dd class="mt-1 truncate text-gray-500 sm:hidden">{{$user->userStatus->name}}</dd>
													<dt class="sr-only">Title</dt>
													<dd class="mt-1 truncate text-gray-700">
														<i class="fa fa-phone mr-2"></i>
														{!! $user->phone ?? '<i class="fa fa-exclamation-triangle text-red-500 mr-2"></i>' . __("PHONE") !!}
													</dd>
													<dt class="sr-only sm:hidden">Email</dt>
													<dd class="mt-1 truncate text-gray-500 sm:hidden">{{$user->email}}</dd>
												</dl>
											</td>
											<td class="hidden px-3 py-4 text-sm text-gray-500 md:table-cell">{{ $user->phone }}</td>
											<td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{$user->email}}</td>
											<td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 flex-col flex items-center lg:space-x-1 lg:flex-row">
												<a href="{{route('backend.users.edit', $user)}}" class="text-gray-600 hover:text-yellow-900">
													<i class="fa fa-edit"></i></a>
												@if(Route::has('backend.users.messages.create'))
													<a href="{{route('backend.users.messages.create', $user)}}" class="text-gray-600 hover:text-yellow-900">
														<i class="fa fa-envelope"></i></a>
												@endif
												@if(Route::has('backend.users.user-notifications.create'))
													<a href="{{route('backend.users.user-notifications.create', $user)}}" class="text-gray-600 hover:text-yellow-900">
														<i class="fa fa-bell"></i>
													</a>
												@endif
											</td>
										</tr>
										@empty
									@endforelse

									<!-- More people... -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div x-show="tab === 'messages'">
					<h3 class="font-bold text-xl">Directions by Car</h3>
					<p class="mt-3">
						Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio,
						dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra
						augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fusce
						dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum.
					</p>
				</div>
				<div x-show="tab === 'tasks'">
					<h3 class="font-bold text-xl">Directions by Car</h3>
					<p class="mt-3">
						Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras justo odio,
						dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra
						augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fusce
						dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum.
					</p>
				</div>
			</div>
		</div>
	</div>
	@push('bottom-scripts')
		<script>
            function tabs() {
                return {
                    active: 1,
                    isActive(tab) {
                        return tab == this.active;
                    },
                }
            }
            function getClasses(tab) {
                if(this.isActive(tab)) {
                    return 'bg-white text-blue-700';
                }
                return 'bg-blue-700 text-gray-700';
            }
		</script>
	@endpush
@endsection