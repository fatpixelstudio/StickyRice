<?php

function svg_icon() {
	return '<svg></svg>';
}

function svg_icon_colored($color = null) {
	if (!isset($color)) {
		$color = '#000000';
	}
	return '<svg>' . $color . '</svg>';

}

?>
