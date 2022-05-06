@if(isset($user))
	<div class="absolute inset-x-0 px-6 bg-gray-100 p-2 text-left flex flex-row space-x-4">
		<div>
			<i class="fa fa-list fa-1x text-yellow-600 mr-1"></i>
			<a href="{{ route('admin.users.contact-attempts.index', $user) }}">{{ __('Contact attempts') }}</a>
		</div>
		<div>
			@if(isset($consultation))
				<i class="fa fa-edit fa-1x text-yellow-600 mr-1"></i>
				<a href="{{ route('admin.users.contact-attempts.show', [$user, $consultation]) }}">{{ __('Show contact attempt') }}</a>
			@endif
		</div>
	</div>
@endif
