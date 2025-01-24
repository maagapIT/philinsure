<ul class="accordion" data-accordion>
	<?php
	$maintenanceMenu = $fpdo
		-> from("menu")
		-> select(NULL)
		-> select("name,label,link,icon,parent")
		-> where("active", true)
		-> where("name in (".$sqlMenu.")")
		-> where("parent", 1)
		-> fetchAll()
	;
	foreach($maintenanceMenu as $value) {
		echo "<li class='accordion-navigation'>";
		include_once($value["link"]);
		echo "</li>";
	}
	?>
</ul>
