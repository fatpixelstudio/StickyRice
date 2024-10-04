<?php

function svg_icon() {
	return '<svg></svg>';
}

function logo() {
	return '<svg></svg>';
}

function svg_icon_colored($color = null) {
	if (!isset($color)) {
		$color = '#000000';
	}
	return '<svg>' . $color . '</svg>';
}

function icon_menu() {
	return '<svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46"><g fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-width="3"><path d="M3.5 11.5h39M3.5 23.5h39M3.5 35.5h39"/></g></svg>';
}

function icon_close() {
	return '<svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46"><g fill="none" fill-rule="evenodd" stroke="#FFF" stroke-linecap="round" stroke-width="3"><path d="m9.557 9.058 27.577 27.577M9.211 36.289 36.789 8.711"/></g></svg>';
}

?>
