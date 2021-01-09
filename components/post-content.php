<? error_reporting(0); ?>
<div id="popular" class="list-posts">
	<? for ($i=0; $i < count($data_post); $i++) {
		$data = $data_post[$i]; ?>
	<div class="post-wrapper">
		<a href="post.php?id=<? echo $data['id']; ?>" class="post flex-col bg-blue">
			<? if($withOwner){ ?>
			<label class="post-title">
				<? echo $user['id'] === $data['idUser'] ? '<i>You</i>' : $data['nameUser']; ?>
			</label>
			<? } ?>
			<div class="content">
				<div class="img-wrapper"><img class="" src="<? echo 'post-file/'.$data['imagePath']; ?>"></div>
				<div class="flex flex-col">
					<label class="title">
						<? echo $data['eventName']; ?>
					</label>
					<label>
						<?
				$desc = $data['eventDescription'];
				$desc = strlen($desc) > 30 ? substr($desc, 0, 30).'...' : $desc;
				echo $desc; ?>
					</label>
				</div>
			</div>
		</a>
	</div>
	<? } ?>
</div>