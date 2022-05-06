@extends('corporate::layouts.master')
@section('content')
	<div class="user-tab-content">
		@includeIf('corporate::users.actions-and-title')
		<div class="sm:flex sm:items-center col-span-full">
			<div class="sm:flex-auto">
				{{ \Eutranet\Commons\Facades\ShowFacade::display('corporate', 'user', $user->id) }}
			</div>
		</div>
	</div>
@endsection