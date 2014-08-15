<?php

namespace auto_username;

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	elgg_register_plugin_hook_handler('action', 'register', __NAMESPACE__ . '\\register_action');
	elgg_register_event_handler('create', 'user', __NAMESPACE__ . '\\create_user');
}


function register_action($h, $t, $r, $p) {
	$username = uniqid();
	while ($user = get_user_by_username($username)) {
		$username = uniqid();
	}
	
	$username = elgg_trigger_plugin_hook('autousername', 'create', array('username' => $username), $username);
	
	set_input('username', $username);
}