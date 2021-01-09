<? error_reporting(0); ?>
<script>
	function searchContact($this) {
		const f = $('.list-posts .post')
		f.each(function(i) {
			const j = $(f[i])
			const title = j.find('.content h3').html()
			const number = j.find('.content h4').html()
			const company = j.find('.content div').html()
			const dataSearch = [title, number, company].join('')
			if (dataSearch.includes($this.value)) {
				j.show()
			} else {
				j.hide()
			}
			if ($this.value === '') j.show()
		})
	}
</script>
<div id="popular" class="list-posts">
	<div class="flex w-full mb-2 justify-end items-center">
		<div class="w-1/3 input-group mb-3">
			<span class="input-group-text">Search</span>
			<input type="text" onkeyup="searchContact(this)" class="form-control" placeholder="Type here...">
		</div>
	</div>
	<?
	for ($i=0; $i < count($data_contact); $i++) { 
		$data = $data_contact[$i]; ?>
	<div class="post-wrapper">
		<div class="post justify-between items-center bg-light">
			<div class="content">
				<h3>
					<? echo $data['name']; ?>
				</h3>
				<h4>
					<? echo $data['phoneNumber']; ?>
				</h4>
				<div>
					<? echo $data['companyName']; ?>
				</div>
			</div>
			<!-- <div class="flex flex-col">
			<i class="fa fa-edit mb-2"></i>
			<i class="fa fa-trash"></i>
		</div> -->
		</div>
	</div>
	<? } ?>
</div>