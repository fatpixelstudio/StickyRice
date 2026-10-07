<?php

/**
 * ----------------------------------------------------------------------------
 * Let editors manage nav menus, without giving them the rest of Appearance
 * ----------------------------------------------------------------------------
 *
 * WordPress core gates Menus, Widgets and the Customizer behind the same
 * 'edit_theme_options' capability, so it can't be granted broadly without
 * also unlocking those. Instead we introduce two capabilities of our own
 * ('edit_nav_menu' and 'manage_nav_menu_items') for editors, and only
 * bridge them to 'edit_theme_options' while the request is actually for
 * the nav menu screen or its AJAX endpoints.
 */

function stickyrice_editor_can_manage_menus( $caps, $cap, $user_id, $args ) {
	$menu_caps = array( 'edit_nav_menu', 'manage_nav_menu_items' );

	if ( ! in_array( $cap, $menu_caps, true ) && 'edit_theme_options' !== $cap ) {
		return $caps;
	}

	$user = get_userdata( $user_id );

	if ( ! $user || ! in_array( 'editor', (array) $user->roles, true ) ) {
		return $caps;
	}

	// Our own capabilities aren't checked anywhere else, so they're always safe to grant.
	if ( in_array( $cap, $menu_caps, true ) ) {
		return array( 'exist' );
	}

	// 'edit_theme_options' also guards Widgets and the Customizer, so only
	// grant it while the editor is actually working with nav menus.
	if ( stickyrice_is_nav_menu_request() ) {
		return array( 'exist' );
	}

	return $caps;
}
add_filter( 'map_meta_cap', 'stickyrice_editor_can_manage_menus', 10, 4 );

function stickyrice_is_nav_menu_request() {
	global $pagenow;

	if ( 'nav-menus.php' === $pagenow ) {
		return true;
	}

	if ( wp_doing_ajax() ) {
		$menu_ajax_actions = array(
			'add-menu-item',
			'menu-get-metabox',
			'menu-locations-save',
			'menu-quick-search',
		);

		$action = isset( $_REQUEST['action'] ) ? sanitize_key( wp_unslash( $_REQUEST['action'] ) ) : '';

		return in_array( $action, $menu_ajax_actions, true );
	}

	return false;
}

// Surface a "Menus" item under Appearance for editors, without exposing
// Themes, Widgets, the Customizer or the Theme File Editor.
function stickyrice_editor_menus_admin_menu() {
	if ( current_user_can( 'edit_theme_options' ) || ! current_user_can( 'manage_nav_menu_items' ) ) {
		return;
	}

	add_submenu_page(
		'themes.php',
		__( 'Menus', 'stickyrice' ),
		__( 'Menus', 'stickyrice' ),
		'manage_nav_menu_items',
		'nav-menus.php'
	);
}
add_action( 'admin_menu', 'stickyrice_editor_menus_admin_menu', 20 );

// While on the nav menus screen itself, 'edit_theme_options' is granted for the
// whole request (see stickyrice_editor_can_manage_menus() above), which also
// lets core's other Appearance submenu items pass their capability check when
// the sidebar is built. Strip everything except Menus back out for editors.
function stickyrice_editor_hide_appearance_submenu() {
	if ( ! in_array( 'editor', (array) wp_get_current_user()->roles, true ) ) {
		return;
	}

	global $submenu;

	foreach ( (array) ( $submenu['themes.php'] ?? array() ) as $item ) {
		if ( 'nav-menus.php' !== $item[2] ) {
			remove_submenu_page( 'themes.php', $item[2] );
		}
	}
}
add_action( 'admin_menu', 'stickyrice_editor_hide_appearance_submenu', 999 );

/**
 * ----------------------------------------------------------------------------
 * Let editors manage Gravity Forms forms and entries (if Gravity Forms exists)
 * ----------------------------------------------------------------------------
 *
 * Editors can create, edit and delete forms and work with their entries, but
 * not reach Gravity Forms' settings, add-ons, system status or uninstall.
 * Granted at runtime instead of stored on the role, so nothing lingers in
 * the database when Gravity Forms is removed.
 */

function stickyrice_editor_can_manage_gravityforms( $caps, $cap, $user_id, $args ) {
	$gravityforms_caps = array(
		'gravityforms_create_form',
		'gravityforms_edit_forms',
		'gravityforms_delete_forms',
		'gravityforms_preview_forms',
		'gravityforms_view_entries',
		'gravityforms_edit_entries',
		'gravityforms_delete_entries',
		'gravityforms_export_entries',
		'gravityforms_view_entry_notes',
		'gravityforms_edit_entry_notes',
	);

	if ( ! in_array( $cap, $gravityforms_caps, true ) || ! class_exists( 'GFForms' ) ) {
		return $caps;
	}

	$user = get_userdata( $user_id );

	if ( ! $user || ! in_array( 'editor', (array) $user->roles, true ) ) {
		return $caps;
	}

	return array( 'exist' );
}
add_filter( 'map_meta_cap', 'stickyrice_editor_can_manage_gravityforms', 10, 4 );
