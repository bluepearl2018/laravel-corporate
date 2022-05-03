<div class="flex flex-row block">
	{{-- Admin selected user feedbacks  --}}
	<a href="{{route('backend.users.feedbacks.index', $selu) }}" class="inline-block flex flex-row"
	   title="{{ __('Feedbacks') }}">
		<i class="fa fa-bullseye self-center text-xl text-yellow-500 mr-4"></i>
	</a>
	{{-- Admin selected user consultations  --}}
	<a href="{{ route('admin.my-space.consultations.index', $selu) }}"
	   class="inline-block flex flex-row" title="{{ __('Consultations') }}">
		<i class="fa fa-calendar-alt self-center text-xl text-yellow-500 mr-4"></i>
	</a>
	{{-- Admin selected user messages  --}}
	<a href="{{ route('backend.users.messages.index', $selu) }}" class="inline-block flex flex-row"
	   title="{{ __('Messages') }}">
		<i class="fa fa-envelope self-center text-xl text-yellow-500 mr-4"></i>
	</a>
	{{-- Admin selected user customers  --}}
	<a href="{{ route('admin.my-space.user-payments.index', $selu) }}" class="inline-block flex flex-row"
	   title="{{ __('User payments') }}">
		<i class="fa fa-cash-register self-center text-xl text-yellow-500 mr-4"></i>
	</a>
	{{-- Admin selected user verdicts  --}}
	<a href="{{ route('backend.users.user-verdicts.index', $selu) }}" class="inline-block flex flex-row"
	   title="{{ __('User verdicts') }}">
		<i class="fa fa-balance-scale self-center text-xl text-yellow-500 mr-4"></i>
	</a>
	{{-- Admin selected user attachments  --}}
	<a href="{{ route('backend.users.user-attachments.index', $selu) }}" class="inline-block flex flex-row"
	   title="{{ __('Attachments') }}">
		<i class="fa fa-file-upload self-center text-xl text-yellow-500 mr-4"></i>
	</a>
</div>
{{-- User info --}}
<div
		class="col-span-1 grid grid-cols-3 bg-gray-50 border-t-4 border-b-4 border-yellow-500 flex flex-row text-center items-center">
	<div
			class="col-span-1 flex flex-col w-full justify-between items-center px-4 border-b text-left border-dashed border-gray-500">
		{{-- Selected user info--}}
		<div class=">
			@if($selu->is_active) <i class="fa fa-circle text-green-300"></i> @else <i
					class="fa fa-circle text-red-300"></i> @endif
			<a class="hover:underline mr-2  font-extrabold uppercase"
			   href="{{ route('backend.users.show', $selu) }}">
				{{$selu->name ?? 'NO NAME'}} ({{ $selu->nif ?? 'NO TAX ID' }})</a>
			<span class="block w-full uppercase font-bold text-base text-left bg-gray-100 text-gray-500">
                                    <i class="fa fa-flag-checkered mr-2"></i>
                                    {{ $selu->userStatus->name }}
                                </span>
		</div>
		{{-- Three user actions--}}
		<div class="flex flex-row">
			<form id="session-flush-selu-frm" action="{{ route('backend.users.flush-selu') }}"
				  method="post">
				@csrf
				<input type="hidden" name="user_id" value="{{ $selu->id }}">
				<button class="ml-2 border rounded-lg p-1 px-2 bg-yellow-500"
						form="session-flush-selu-frm" type="submit"
						title="{{ __('Forget selected user') }}">
					<i class="fa fa-user-slash text-gray-100"></i>
				</button>
			</form>
			@if(!is_null($selu->userFlags->first()))
				<a href="{{ route('backend.users.user-flags.show', [$selu, $selu->userFlags->first()]) }}"
				   class="ml-2 border rounded-lg p-1 px-2 bg-yellow-500"
				   title="{{ __('Get history') }}">
					<i class="fa fa-history text-gray-100"></i>
				</a>
			@endif
			<a href="{{ route('backend.users.create') }}" class="ml-2 border rounded-lg p-1 px-2 bg-yellow-500"
			   title="{{ __('Create a new contact') }}">
				<i class="fa fa-user-plus text-gray-100"></i>
			</a>
		</div>
	</div>
	<div class="col-span-2">
		{{-- USER TABS --}}
		<x-users.tabs.menu></x-users.tabs.menu>
	</div>
</div>
