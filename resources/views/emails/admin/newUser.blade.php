<h3>
	Dear {{ $admin->name }},
</h3>

<p>
	You have a new user registered.
</p>

<table border="1">
	<tr>
		<th>Name</th>
		<td>{{ $user->name }}</td>
	</tr>
	<tr>
		<th>Email address</th>
		<td>{{ $user->email }}</td>
	</tr>
	<tr>
		<th>Phone number</th>
		<td>+234{{ $user->phone }}</td>
	</tr>
	<tr>
		<th>Location</th>
		<td>{{ $user->city->name }}, {{ $user->city->state->name }}</td>
	</tr>
</table>

<footer>
	<p>
		Regards. <br>
		SavyCon &copy; 2019
	</p>
</footer>