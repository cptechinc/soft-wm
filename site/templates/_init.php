<?php

/**
 * Initialization file for template files
 *
 * This file is automatically included as a result of $config->prependTemplateFile
 * option specified in your /site/config.php.
 *
 * You can initialize anything you want to here. In the case of this beginner profile,
 * we are using it just to include another file with shared functions.
 *
 */

include_once("./_func.php"); // include our shared functions
include_once("./_dbfunc.php");
$config->styles->append(hash_templatefile('styles/bootstrap.min.css'));
$config->styles->append('//fonts.googleapis.com/css?family=Lusitana:400,700|Quattrocento:400,700');
$config->styles->append('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$config->styles->append('//www.fuelcdn.com/fuelux/3.13.0/css/fuelux.min.css');
$config->styles->append(hash_templatefile('styles/main.css'));

$config->scripts->append('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
$config->scripts->append(hash_templatefile('scripts/popper.js'));
$config->scripts->append(hash_templatefile('scripts/bootstrap.min.js'));
$config->scripts->append('//www.fuelcdn.com/fuelux/3.13.0/js/fuelux.min.js');
$config->scripts->append(hash_templatefile('scripts/uri.js'));
$config->scripts->append(hash_templatefile('scripts/main.js'));



// AFTER LOADING CONFIGS, CLASSES, AND FUNCTIONS CHECK FOR LOGIN
$user->loggedin = is_validlogin(session_id());

// if ($user->loggedin) {
// 	setup_user(session_id());
// } elseif ($page->template != 'login' && $page->template != 'redir') {
// 	header('location: ' . $config->pages->login);
// 	exit;
// }

// BUILD AND INSTATIATE CLASSES
$page->fullURL = new Purl\Url($page->httpUrl);
$page->fullURL->path = '';
if (!empty($config->filename) && $config->filename != '/') {
	$page->fullURL->join($config->filename);
}

// SET CONFIG PROPERTIES
if ($input->get->modal) {
	$config->modal = true;
}

if ($input->get->json) {
	$config->json = true;
}
