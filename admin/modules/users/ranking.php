
<h2 class="text-center" style="color:darkcyan">Ranking</h2>


<div class="container">
	<table class="table table-inverse table-hover">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Total view</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$users = mysqli_query($conn,"SELECT * FROM users ORDER BY total_view DESC");
			foreach($users as $user) : 
				?>
			<tr>
				<td><?= $user['username'] ?></td>
				<td><?= $user['email'] ?></td>
				<td><?= $user['total_view'] ?></td>			
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>


