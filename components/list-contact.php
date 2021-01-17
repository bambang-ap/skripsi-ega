<?php error_reporting(0); ?>
<script>
	function searchContact($this) {
		var components = $('.list-posts .post')
		components.each(function(i) {
			var selector = $(components[i])
			var title = selector.find('.content h3').html()
			var number = selector.find('.content h4').html()
			var company = selector.find('.content div').html()
			var dataSearch = [title, number, company].join('')
			if (dataSearch.toLowerCase().includes($this.value.toLowerCase())) {
				selector.show()
			} else {
				selector.hide()
			}
			if ($this.value === '') j.show()
		})
	}
</script>
<div id="popular" class="list-posts">
	<div class="flex w-full mb-2 justify-end items-center search-wrapper">
		<div class="w-1/3 input-group mb-3">
			<span class="input-group-text">Search</span>
			<input type="text" onkeyup="searchContact(this)" class="form-control" placeholder="Type here...">
		</div>
	</div>
	<?php
	for ($i = 0; $i < count($data_contact); $i++) {
		$data = $data_contact[$i]; ?>
		<div class="post-wrapper">
			<div class="post justify-between items-center bg-light" onclick="openPopup(this)">
				<div class="content">
					<h3><?php echo $data['name']; ?></h3>
					<h4><?php echo $data['phoneNumber']; ?></h4>
					<div><?php echo $data['companyName']; ?></div>
				</div>
				<!-- <div class="flex flex-col">
			<i class="fa fa-edit mb-2"></i>
			<i class="fa fa-trash"></i>
		</div> -->
			</div>
		</div>
	<?php } ?>
</div>