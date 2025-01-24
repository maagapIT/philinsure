<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MAAGAP ePortal System</title>
<script src="scripts/jquery-2.1.3.min.js"></script>
<script src="scripts/angular.min.js"></script>
<script src="scripts/foundation.min.js"></script>
<script src="scripts/modernizr.js"></script>
<script src="scripts/datatables.min.js"></script>
<script src="scripts/chosen.jquery.min.js"></script>
<script src="scripts/functions.js"></script>
<link rel="stylesheet" type="text/css" href="scripts/chosen.min.css" />
<link rel="stylesheet" type="text/css" href="scripts/foundation.min.css" />
<link rel="stylesheet" type="text/css" href="scripts/foundation-icons.css" />
<link rel="stylesheet" type="text/css" href="scripts/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="scripts/common.css" />
<!--link rel="stylesheet" type="text/css" href="scripts/testing.css" /-->
<?php include_once("scripts/function.php"); ?>
<div id="alert" class="reveal-modal small" aria-hidden="true" role="dialog" data-reveal>
	<h5><i class=""></i>&nbsp;<span></span></h5>
	<p></p>
	<button class="button right radius mod-button" tabindex="0" onclick="$('#alert').foundation('reveal', 'close');">OK</button>
</div>
<div id="confirmation" class="reveal-modal small" aria-hidden="true" role="dialog" data-reveal>
	<h5><i class=""></i>&nbsp;<span></span></h5>
	<p></p>
	<div class="right">
		<button id="confirmed" class="button mod-button radius" tabindex="0">Yes</button>
		<button class="button mod-button radius" tabindex="0" onclick="$('#confirmation').foundation('reveal', 'close');">No</button>
	</div>
</div>
