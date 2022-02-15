<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Charts</title>
</head>
<body>
	<?php include "adminHeader.php"; ?>
	<div class="page-wrapper">
		<div class="flex-container">
			<div style="flex-grow: 1"><canvas id="myChart" width="100" height="100"></canvas></div>
			<div style="flex-grow: 1"><canvas id="myChart2" width="100" height="100"></canvas></div>
			<div style="flex-grow: 1"><canvas id="myChart3" width="100" height="100"></canvas></div>
			<script src = 'chart.js'></script>
		</div>
	</div>
	<?php include "footer.php";?>
</body>
</html>
