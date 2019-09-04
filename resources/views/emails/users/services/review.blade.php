<h3>
	Dear {{ $review->userService->user->name }},
</h3>

<p>This is to notify you that you have a new review for your service.</p>
<table border="1">
	<tr>
		<th>Comment</th>
		<th>Stars</th>
	</tr>
	<tr>
		<td>{{ $review->comment }}</td>
		<td>{{ $review->stars }}</td>
	</tr>
	<tr>
		<th colspan="2" align="center">Service Details</th>
	</tr>
	<tr>
		<th>Title</th>
		<td>{{ $review->userService->title }}</td>
	</tr>
	<tr>
		<th>Description</th>
		<td>{{ $review->userService->description }}</td>
	</tr>
</table>

<p>
	<a href="{{ route('service.single', ['id' => $review->userService->id]) }}">Open Service</a>
</p>

<footer>
	<p>
		Regards. <br>
		SavyCon &copy; 2019
	</p>
</footer>