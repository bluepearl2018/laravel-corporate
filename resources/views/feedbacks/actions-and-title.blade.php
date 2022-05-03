@if(isset($selu))
    <div class="absolute inset-x-0 px-6 bg-gray-100 p-2 text-left">
        <i class="fa fa-list fa-1x text-yellow-600 mr-1"></i>
        <a href="{{route('backend.users.user-agreements.index', $selu)}}">{{ __('User agreements') }}</a>
    </div>
@endif
