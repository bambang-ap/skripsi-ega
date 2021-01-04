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
		<div class="flex flex-wrap content-stretch">
			<!-- Post start -->
			<div class="flex flex-col w-1/3">
				<label>Owner</label>
				<div class="">
					<img src="assets/img.png">
					<label>deskripsi file disini</label>
				</div>
			</div>
			<div class="flex flex-col w-1/3">
				<label>Owner</label>
				<div class="">
					<img src="assets/img.png">
					<label>deskripsi file disini</label>
				</div>
			</div>
			<div class="flex flex-col w-1/3">
				<label>Owner</label>
				<div class="">
					<img src="assets/img.png">
					<label>deskripsi file disini</label>
				</div>
			</div>
		</div>
		<!-- Post end -->
		<? require('components/footer.php');?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>