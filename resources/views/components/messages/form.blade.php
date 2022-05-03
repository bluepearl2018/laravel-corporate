<!-- Contact form -->
<div class="px-6 py-4 border rounded-lg">
	<div class="bg-gray-100 p-4 mb-2">
		{{__('This message will be sent to the user you have selected.')}}
	</div>
	<x-theme-form-validation-errors></x-theme-form-validation-errors>
	<form id="send-message-to-user-frm" action="{{route('admin.send-message-to-user', $user) }}" method="POST" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
		@csrf
		<div>
			<label for="from-email" class="block text-sm font-medium text-gray-900">From</label>
			<div class="mt-1">
				<input id="from-email" name="from" type="email"
					   value="{{ Auth::user()->email }}"
					   autocomplete="email"
					   readonly
					   required
					   class="py-2 px-4 block w-full bg-gray-100 shadow-sm text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 border-gray-300 rounded-md">
			</div>
		</div>
		<div>
			<label for="to-email" class="block text-sm font-medium text-gray-900">To</label>
			<div class="mt-1">
				<input id="to-email" name="to" type="email"
					   value="{{ $user->email }}"
					   autocomplete="email"
					   readonly
					   required
					   class="py-2 px-4 block w-full bg-gray-100 shadow-sm text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 border-gray-300 rounded-md">
			</div>
		</div>
		<input type="hidden" name="user_id" value="{{$user->id}}" />
		<input type="hidden" name="staff_member_id" value="{{Auth::id()}}" />
		<div class="sm:col-span-2">
			<label for="subject" class="block text-sm font-medium text-gray-900">Subject</label>
			<div class="mt-1">
				<input type="text" required minlength="5" maxlength="140" name="subject" id="subject" class="py-2 px-4 block w-full shadow-sm text-gray-900 focus:ring-yellow-500 focus:border-yellow-500 border-gray-300 rounded-md">
			</div>
		</div>
		<div class="sm:col-span-2">
			<div class="flex justify-between">
				<label for="message" class="block text-sm font-medium text-gray-900">Message</label>
				<span id="message-max" class="text-sm text-gray-500">Max. 500 characters</span>
			</div>
			<div class="mt-1">
				<textarea id="message" name="message_body" rows="8"
						  minlength="5" maxlength="500" required
						  class="py-2 px-4 block w-full shadow-sm text-gray-900
						  focus:ring-yellow-500 focus:border-yellow-500 border
						  border-gray-300 rounded-md" aria-describedby="message-max"></textarea>
			</div>
		</div>
		<div class="sm:col-span-2 sm:flex sm:justify-end">
			<button form="send-message-to-user-frm" type="submit" class="mt-2 w-full inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2
			focus:ring-offset-0 focus:ring-yellow-500 sm:w-auto">{{__('Send')}}</button>
		</div>
	</form>
</div>