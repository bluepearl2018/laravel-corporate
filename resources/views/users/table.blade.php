<div class="user-tab-content">
	@includeIf('corporate::users.actions-and-title')
	<div class="sm:flex sm:items-center col-span-full">
		<div class="sm:flex-auto">
			<x-theme-h1>
				<strong>{{ \App\Models\User::count() }} User{{App\Models\User::count() > 1 ? '(s)' : '' }} {{ __('labels.found') }} </strong>
				<span class="text-base">
                        (
                        <a class="px-1" href="{{ route('admin.users.index') }}">
                            <span>{{ __('Display all') }} | </span>
                        </a>
                        <a class="bg-yellow-200 px-1 font-bold" href="{{ URL::current().'?filter=contact'}}">
                            {{ \App\Models\User::where('user_status_id', 1)->get()->count() }}
                            <span class="text-base">{{ __('to be reviewed')  }}</span>
                        </a>
                    )
                </span>
			</x-theme-h1>
			<p class="mb-2 italic">{{__('Users are sorted by descendant date of creation. Some basic filters can be applied.')}}.</p>
			{{-- FILTERS --}}
			<div class="font-semibold flex flex-row md:space-x-2 items-center">
				@foreach(\Eutranet\Commons\Models\UserStatus::all() as $userStatus)
					<a class="col-span-1 text-center inline-block" href="{{ URL::current().'?filter='.$userStatus->code}}">
                        <span class="uppercase inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium font-bold
                            @if(Request::get('filter') == $userStatus->code) bg-yellow-500 text-gray-700 @else bg-gray-100 text-gray-800 @endif">
                            {{ $userStatus->code }}
                        </span>
					</a>
				@endforeach
			</div>
		</div>
	</div>
	<div class="col-span-full">
		<table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-xl">
			<thead class="bg-gray-50">
			<tr>
				<th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">{{__('Name')}}</th>
				<th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">{{__('user-employments.Function')}}</th>
				<th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">{{__('Assigned to')}}</th>
				<th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{__('Status')}}</th>
				<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
					<span class="sr-only">{{__('Select')}}</span>
				</th>
			</tr>
			</thead>
			<tbody class="bg-white divide-y divide-gray-200">
			@forelse($users as $user)
				<tr>
					<td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm">
						<div class="text-sm font-medium text-gray-900">
							<a href="{{ route('admin.users.show', $user) }}">{{  $user->name }}</a>
						</div>
						<div class="mt-1 flex flex-col text-gray-500 block">
							<div>
								<div class="text-sm text-gray-500">
									<a href="{{ route('admin.users.messages.create', $user) }}">{{  $user->email }}</a>
								</div>
								<div class="text-sm text-gray-500">
									@if(isset($user->nif))
										{{ __('Tax ID: ') }} <span
												class="bg-yellow-500 py-0.5 px-1 rounded text-gray-900 px-1">{{$user->nif}}</span>
									@else
										<div class="flex flex-row space-x-2">
											<i class="fa fa-exclamation-circle text-red-500 self-center"></i>
											<a href="{{ route('admin.users.show', $user) }}"
											   class="border rounded px-2">Enter tax profile</a>
										</div>
									@endif
								</div>
							</div>
						</div>
					</td>
					<td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
						<div class="text-sm text-gray-900 text-center">{{ $user->function  }}</div>
						<div
								class="text-sm text-gray-800 bg-gray-100 text-center">{{ $user->is_staff ? __('Staff') : __('User') }}
						</div>
						<div
								class="text-center px-2 text-xs leading-5 font-semibold rounded-full @if(!$user->is_active) bg-red-100 text-red-800 @endif">
							{{ $user->is_active ? __('Active') : __('Inactive') }}
						</div>
					</td>
					<td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">
						<div class="text-sm text-gray-500 text-center">
							@if(isset($user->staffMembers) && $user->staffMembers->first() !== NULL)
								<i class="fa fa-check-circle text-green-500 mr-2"></i>
								<div class="text-sm text-gray-900 text-center">
									<div>
										{{ $user->staffMembers->first()?->name }}
									</div>
									{{ $user->staffMembers->first()?->agency?->zone }}
									@else
										@role('super-staff')
										<div class="flex flex-row justify-items-center justify-center space-x-2">
											<i class="self-center fa fa-exclamation-circle text-red-500"></i>
											<form id="staff-assign-user-frm-{{ $loop->index }}"
												  action="{{ route('admin.staff-members.assign-staff-to-user') }}"
												  method="POST">
												@csrf
												<input type="hidden" id="{{ $user->id }}-staff-user-id"
													   name="user_id" value="{{ $user->id }}"/>
												<label for="staff-select-{{$loop->index}}"></label>
												<select id="staff-select-{{$loop->index}}" name="staff_member_id"
														class="form-select text-xs py-0.5 border-gray-200"
														required>
													<option value="">{{ __('Assign Staff') }}</option>
                                                        @foreach(Eutranet\Corporate\Models\StaffMember::select('id', 'name')->get() as $staffMember)
															<option value="{{ $staffMember->id }}" @if(Auth::id() === $staffMember->id) selected @endif>
																{{ $staffMember->name }}
															</option>
														@endforeach
												</select>
												<button type="submit"
														form="staff-assign-user-frm-{{ $loop->index }}"
														title="{{ __('labels.Save') }}">
													<i class="fa fa-save inline-block mx-2"></i>
												</button>
											</form>
										</div>
										@endrole
									@endif
								</div>
						</div>
					</td>
					<td class="px-3 py-3.5 text-sm text-gray-500">
						@isset($user->userStatus)
							{{ $user->userStatus->name }}
						@endif
					</td>
					<td class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium">
						<div class="items-center flex-col flex space-y-1 items-center ">
							<i class="fa fa-envelope"></i>
							<i class="fa fa-phone"></i>
						</div>
					</td>
				</tr>
			@empty
			@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5">
						@if($users instanceof \Illuminate\Pagination\LengthAwarePaginator )
							<div class="w-full p-3 block">
								{{ $users->links() }}
							</div>
						@endif
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
