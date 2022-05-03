@if(Auth::user()->hasRole('super-staff'))
	<x-theme-h2 class="leading-6 text-yellow-600 mt-8 font-extrabold tracking-wide uppercase text-lg">
		{{ __('Permissions') }}
	</x-theme-h2>
	@forelse($user->permissions as $permission)
		{{$permission}}
		@empty
		<p class="mt-4 text-lg text-gray-500">{{__('No permission set') }}</p>
	@endforelse
@endif