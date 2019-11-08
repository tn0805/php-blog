<?php 
	$id = $login['id'];
	$query = mysqli_query($conn,"SELECT * FROM users WHERE id = $id");
	$userInfo = mysqli_fetch_assoc($query);
 ?>
<h2 class="text-center" style="color:darkcyan">User information</h2>

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $userInfo['username'] ?></td>
			<td><?= $userInfo['email'] ?></td>
			<td><a href="index.php?m=users&a=edit" class="btn btn-primary">Edit</a></td>
		</tr>
	</tbody>
</table>