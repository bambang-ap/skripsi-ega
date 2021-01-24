<?php
$isInContact = strpos($_SERVER['REQUEST_URI'], 'contact.php')
?>
<script>
	function remove($this) {
		if ($this.checked && !confirm(`Are you sure want to delete "${name}"?`)) {
			event.preventDefault()
		} else {
			$('#btn-save').removeClass('none')
			$($this).parent().parent().parent().hide()
		}
	}

	function edit(id) {
		$('#btn-save').removeClass('none')
		var selector = $(`#${id}`)
		selector.find('.viewer').addClass('none')
		selector.find('.editor').removeClass('none')
	}

	function searchContact($this) {
		var components = $('.list-posts .post')
		components.each(function(i) {
			var selector = $(components[i])
			var title = selector.find('.content h3').html()
			var number = selector.find('.content h4').html()
			var company = selector.find('.content div').html()
			var dataSearch = [title, number, company].join('')
			if (dataSearch.toLowerCase().includes($this.value.toLowerCase())) {
				selector.parent().show()
			} else {
				selector.parent().hide()
			}
			if ($this.value === '') selector.show()
		})
	}
	$(document).ready(function() {
		$('input[type=search]').on('search', function() {
			searchContact($(this)[0])
		})
	})
</script>
<form id="popular" action="manage/edit-delete-contact.php" method="POST" class="list-posts">
	<div class="flex w-full mb-3 justify-end items-center search-wrapper">
		<?php if ($isInContact) { ?>
			<input id="btn-save" class="none w-1/3 btn btn-primary" type="submit" value="SAVE">
		<?php } ?>
		<div class="w-1/3 input-group ml-3">
			<span class="input-group-text">Search</span>
			<input type="search" onkeypress="if (event.key === 'Enter') event.preventDefault()" onkeyup="searchContact(this)" class="form-control" placeholder="Type here...">
		</div>
	</div>
	<?php
	for ($i = 0; $i < count($data_contact); $i++) {
		$data = $data_contact[$i]; ?>
		<div id="contact-<?php echo $data['id']; ?>" class="post-wrapper">
			<input class="none" type="text" name="data[<?php echo $i; ?>][id]" value="<?php echo $data['id']; ?>" />
			<input class="none" type="text" name="data[<?php echo $i; ?>][idOwner]" value="<?php echo $data['idOwner']; ?>" />
			<div class="post justify-between items-center bg-light" onclick="openPopup(this)">
				<div class="content">
					<?php if ($isInContact) { ?>
						<div class="editor mr-2 none">
							<div class="input-group mb-1" title="Name or alias">
								<span class="input-group-text">Name</span>
								<input type="text" class="form-control" name="data[<?php echo $i; ?>][name]" value="<?php echo $data['name']; ?>" placeholder="e.g. Makmur Sukimin">
							</div>
							<div class="input-group mb-1" title="Please use country code without (+) plus sign">
								<span class="input-group-text">Number</span>
								<input type="number" class="form-control" name="data[<?php echo $i; ?>][phoneNumber]" value="<?php echo $data['phoneNumber']; ?>" placeholder="e.g. 6285712344321">
							</div>
							<div class="input-group mb-1" title="Company name or else to identify this person">
								<span class="input-group-text">Company</span>
								<input type="text" class="form-control" name="data[<?php echo $i; ?>][companyName]" value="<?php echo $data['companyName']; ?>" placeholder="e.g. PT. Makmur Jaya">
							</div>
						</div>
					<?php } ?>
					<div class="viewer">
						<h3><?php echo $data['name']; ?></h3>
						<h4><?php echo $data['phoneNumber']; ?></h4>
						<div><?php echo $data['companyName']; ?></div>
					</div>
				</div>
				<?php if ($isInContact) { ?>
					<div class="flex flex-col">
						<i onclick="edit('contact-<?php echo $data['id']; ?>')" class="text-2xl pointer fa fa-edit mb-2"></i>
						<label class="pointer" for="id-<?php echo $i; ?>"><i class="text-2xl fa fa-trash"></i></label>
						<input class="none" id="id-<?php echo $i; ?>" type="checkbox" onclick="remove(this, '<?php echo $data['name']; ?>')" name="data[<?php echo $i; ?>][deleted]" />
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</form>