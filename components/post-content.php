<? error_reporting(0); ?>
<div id="popular" class="list-posts">
	<? for ($i=0; $i < count($data_post); $i++) { ?>
	<a href="post.php?id=idnya" class="post flex-col bg-blue">
		<? if($withOwner){ ?>
		<label>Owner</label>
		<? } ?>
		<div class="content">
			<img src="assets/images/img.png">
			<label class="title">WAYMAKER</label>
			<label>ON FRIDAY AT 7 PM VIA ZOOM ONLY</label>
		</div>
	</a>
	<? } ?>
</div>