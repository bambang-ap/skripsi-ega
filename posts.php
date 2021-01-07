<!doctype html>
<html lang="en" class="h-full">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? require('components/imports.php'); ?>
	<title>Hello, world!</title>
</head>

<body>
	<? require('components/header.php');?>
	<div class="app">
		<form class="flex form-post">
			<div>
				<h2 class="pb-5">POST YOUR EVENT</h2>
				<div class="flex mb-2">
					<div class="w-1/3 mr-2 img-wrapper">
						<img src="assets/images/img.png">
						<div class="icon-wrapper">
							<a href="#"><i class="fa fa-edit icon"></i></a>
						</div>
					</div>
					<div class="flex flex-col flex-1">
						<div class="flex">
							<div class="w-1/2 mr-1">
								<label class="form-label">Event name</label>
								<input type="text" class="form-control" placeholder="Type here...">
							</div>
							<div class="w-1/2 ml-1">
								<label class="form-label">Youtube link</label>
								<input type="text" class="form-control" placeholder="Type here...">
							</div>
						</div>
						<label class="form-label">Event description</label>
						<textarea class="h-full form-control" placeholder="Type here..."></textarea>
					</div>
				</div>
			</div>
			<button class="btn btn-primary" type="submit">POST</button>
		</form>
		<h2 class="text-center pb-5">YOUR EVENTS</h2>
		<?
			$data_post = [1,2,3,4,5,6];
			require('components/post-content.php');
			require('components/footer.php');
		?>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>