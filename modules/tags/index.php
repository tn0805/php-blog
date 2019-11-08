
<h2 class="text-center" style="color:darkcyan">User information</h2>

<div class="container">
	<table class="table table-inverse table-hover">
		<thead>
			<tr>
				<th>Tags</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tags as $tag) : ?>
			<tr>
				<td><a href="index.php?m=tags&a=view&id=<?php echo $tag['tag_id']; ?>"><?= $tag['tag_name'] ?></a></td>
				<td><a href="index.php?m=tags&a=edit&id=<?= $tag['tag_id'] ?>" class="btn btn-primary">Edit</a>
					<a href="index.php?m=tags&a=delete&id=<?= $tag['tag_id'] ?>" class="btn btn-danger" onclick="return confirm('Delete?')">Delete</a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	 <div class="">
	 	<a href="index.php?m=tags&a=create" class="btn btn-primary">Create</a>
	 </div>
</div>
