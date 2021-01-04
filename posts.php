<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
	<title>Hello, world!</title>
</head>

<body class="flex flex-col items-center h-full">
	<? require('components/header.php');?>
	<div class="flex flex-col h-full w-3/5">
		<form class="flex flex-col items-end">
			<div class="flex mb-2">
				<div class="w-1/3 mr-2"><img src="assets/img.png"></div>
				<div class="flex flex-col flex-1">
					<textarea style=" resize: none;" placeholder="Type here..." class="p-2 form-control w-full h-full"></textarea>
				</div>
			</div>
			<button class="btn btn-primary" type="submit">POST</button>
		</form>
		<!-- list start -->
		<div class="flex flex-col flex-1">
			<div class="">
				<img src="assets/img.png">
				<label>deskripsi file disini</label>
			</div>
		</div>
		<div class="flex flex-col flex-1">
			<div class="">
				<img src="assets/img.png">
				<label>deskripsi file disini</label>
			</div>
		</div>
		<div class="flex flex-col flex-1">
			<div class="">
				<img src="assets/img.png">
				<label>deskripsi file disini</label>
			</div>
		</div>
		<!-- list end -->
		<? require('components/footer.php');?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>