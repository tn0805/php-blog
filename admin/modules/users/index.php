
<h2 class="text-center" style="color:darkcyan">User information</h2>

<div class="container">
	<table class="table table-inverse table-hover">
		<?php if($login['level'] == 1) : ?>
		<a href="index.php?m=users&a=create" class="btn btn-success">Add User</a>
	<?php endif; ?>
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Password</th>
				<th>Level</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $user) : ?>
				<?php if($login['id'] == $user['id'] || $login['level'] == 1) : ?>
			<tr>
				<td><?= $user['username'] ?></td>
				<td><?= $user['email'] ?></td>
				<td><?= $user['password'] ?></td>
				<td><?php if ($user['level'] == 1) : ?>
					<?= 'ADMIN' ?></td>
					<?php else : ?>
					<?= 'USER' ?></td>
				<td>
					<a href="index.php?m=users&a=edit&id=<?= $user['id']; ?>" class="btn btn-primary">Edit</a>
					<?php if($login['level'] == 1) : ?>
					<a href="index.php?m=users&a=delete&id=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a>
				<?php endif; ?>
				</td>	
					<?php endif; ?>			
			</tr>
		<?php endif; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
