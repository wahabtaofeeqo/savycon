<h3>Dear {{ $admin->name }},</h3>

<p>This is to notify you of a new message dropped on a service rendered on your app.</p>

<table border="1">
	<tr>
		<th colspan="2" align="center">Message Content</th>
	</tr>
	<tr>
		<th>Sender Name</th>
		<td>{{ $msg->name }}</td>
	</tr>
	<tr>
		<th>Sender Email address</th>
		<td>{{ $msg->email }}</td>
	</tr>
	<tr>
		<th>Sender Phone number</th>
		<td>{{ $msg->phone }}</td>
	</tr>
	<tr>
		<th>Message</th>
		<td>{{ $msg->message }}</td>
	</tr>
	<tr>
		<th colspan="2" align="center">Service Details</th>
	</tr>
	<tr>
		<th>Title</th>
		<td>{{ $msg->userService->title }}</td>
	</tr>
	<tr>
		<th>Description</th>
		<td>{{ $msg->userService->description }}</td>
	</tr>
</table>

<p>
	<a href="{{ route('service.single', ['id' => $msg->userService->id]) }}">Open Service</a>
</p>

<footer>
	<p>
		Regards. <br>
		SavyCon &copy; 2019
	</p>
</footer>