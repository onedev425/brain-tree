<x-mail::message>
# The status of your application has changed

<x-mail::panel>
	@switch(strtolower($status))
		@case('approved')
Congratulations, your application has been approved. Log in to see new changes now.
			@break
		@case('application received')
Your application has been received, further instructions would be sent to you.
			@break
		@case('under review')
Your application is currently under review, you would be notified when a decision is made.
			@break
		@case('rejected')
Your application was unfortunately rejected.
			@break
		@default
This email has been sent to you because your application status has changed to {{$status}}.
	@endswitch
	<br>
	<br>
	@isset($reason)
Reason/Message -  {{ $reason }} 
	@endisset
	<x-mail::button url="{{route('dashboard')}}">
	Log in
	</x-mail::button>
	
</x-mail::panel>

<br>
Note that this is an automated email.
<br>
Regards, 
<br>
	{{config('app.name')}}

</x-mail::message>
