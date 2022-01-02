<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Admin Search</title>
</head>
<body>
	<?php include "adminHeader.php"; ?>
	<br>
	<div class="ui-widget"  style="text-align:left;">
	<input id="autocomplete" placeholder="Search for: Store"></div>
	<div id="map" ></div>
	<?php include "footer.php";?>
	<script src = "map.js"></script>
</body>
</html>