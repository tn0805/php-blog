
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
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

</div>
