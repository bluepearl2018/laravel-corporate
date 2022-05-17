<div class="absolute inset-x-0 px-6 bg-gray-100 p-2 text-left flex flex-row space-x-4">
	<div>
		<i class="fa fa-list fa-1x text-yellow-600 mr-1"></i>
		<a href="{{ route('admin.users.index') }}">Users</a>
	</div>
	@if(isset($user))
	@endif
</div>
