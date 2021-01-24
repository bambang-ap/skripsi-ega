<?php error_reporting(0); ?>
<div id="popular" class="list-posts">
	<?php for ($i = 0; $i < count($data_post); $i++) {
		$data = $data_post[$i]; ?>
		<div class="post-wrapper">
			<a href="posts.php?edit=<?php echo $data['id']; ?>">Edit</a>
			<a onclick="if (!confirm('Are you sure want to delete this?')) event.preventDefault()" href="manage/edit-delete-post.php?id=<?php echo $data['id']; ?>">Delete</a>
			<a href="post.php?id=<?php echo $data['id']; ?>" class="post flex-col bg-blue">
				<?php if ($withOwner) { ?>
					<label class="post-title">
						<?php echo $user['id'] === $data['idUser'] ? '<i>You</i>' : $data['nameUser']; ?>
					</label>
				<?php } ?>
				<div class="content">
					<div class="img-wrapper"><img class="" src="<?php echo 'post-file/' . $data['imagePath']; ?>"></div>
					<div class="flex flex-col">
						<label class="title">
							<?php echo $data['eventName']; ?>
						</label>
						<label>
							<?php
							$desc = $data['eventDescription'];
							$desc = strlen($desc) > 30 ? substr($desc, 0, 30) . '...' : $desc;
							echo $desc;
							?>
						</label>
					</div>
				</div>
			</a>
		</div>
	<?php } ?>
</div>