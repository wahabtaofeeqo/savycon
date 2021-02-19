<h3>Dear {{ $user->name }},</h3>

<p>
	It is our pleasure to welcome you to <b>SavyCon</b>.
	<p>
		Please feel free to play around the website and dashboard.
		<p>
			Verify the content on your profile to help us provide a tailored service for you <a href="{{ env('APP_URL') }}/{{ $user->role }}/profile">here</a>
		</p> 
		We are here to assist you all-the-way.
	</p>
</p>

<footer>
	<p>
		Regards. <br>
		SavyCon &copy; 2019
	</p>
</footer>