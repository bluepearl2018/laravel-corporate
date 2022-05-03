@if(!is_null($selu))
	<div class="absolute inset-x-0 px-6 bg-gray-100 p-2 text-left flex flex-row space-x-4">
		<div>
			<i class="fa fa-list fa-1x text-yellow-600 mr-1"></i>
			<a href="{{ route('admin.users.laravel-consultations.index', $selu) }}">{{ __('Consultations') }}</a>
		</div>
		<div>
			@if(isset($consultation))
				<i class="fa fa-edit fa-1x text-yellow-600 mr-1"></i>
				<a href="{{ route('admin.users.laravel-consultations.show', [$selu, $consultation]) }}">{{ __('Modificar consulta') }}</a>
			@endif
		</div>
	</div>
@endif
