<?php namespace ProcessWire;

/**
 * ProcessWire Configuration File
 *
 * Site-specific configuration for ProcessWire
 *
 * Please see the file /wire/config.php which contains all configuration options you may
 * specify here. Simply copy any of the configuration options from that file and paste
 * them into this file in order to modify them.
 *
 * SECURITY NOTICE
 * In non-dedicated environments, you should lock down the permissions of this file so
 * that it cannot be seen by other users on the system. For more information, please
 * see the config.php section at: https://processwire.com/docs/security/file-permissions/
 *
 * This file is licensed under the MIT license
 * https://processwire.com/about/license/mit/
 *
 * ProcessWire 3.x, Copyright 2016 by Ryan Cramer
 * https://processwire.com
 *
 */

if(!defined("PROCESSWIRE")) die();

/*** SITE CONFIG *************************************************************************/

/** @var Config $config */

/**
 * Enable debug mode?
 *
 * Debug mode causes additional info to appear for use during dev and debugging.
 * This is almost always recommended for sites in development. However, you should
 * always have this disabled for live/production sites.
 *
 * @var bool
 *
 */
$config->debug = false;

/**
 * Prepend template file
 *
 * PHP file in /site/templates/ that will be loaded before each page's template file.
 * Example: _init.php
 *
 * @var string
 *
 */
$config->prependTemplateFile = '_init.php';


/*** INSTALLER CONFIG ********************************************************************/

/**
 * Installer: Database Configuration
 *
 */
$config->dbHost = 'localhost';
$config->dbName = 'pw_wm';
$config->dbUser = 'cptecomm';
$config->dbPass = 'rghopeless';
$config->dbPort = '3306';

/**
 * Installer: User Authentication Salt
 *
 * Must be retained if you migrate your site from one server to another
 *
 */
$config->userAuthSalt = '34227de2d576b4e03578a345f2d0588e';

/**
 * Installer: File Permission Configuration
 *
 */
$config->chmodDir = '0755'; // permission for directories created by ProcessWire
$config->chmodFile = '0644'; // permission for files created by ProcessWire

/**
 * Installer: Time zone setting
 *
 */
$config->timezone = 'America/Chicago';

/**
 * Installer: Admin theme
 *
 */
$config->defaultAdminTheme = 'AdminThemeUikit';

/**
 * Installer: Unix timestamp of date/time installed
 *
 * This is used to detect which when certain behaviors must be backwards compatible.
 * Please leave this value as-is.
 *
 */
$config->installed = 1546967386;


/**
 * Installer: HTTP Hosts Whitelist
 *
 */
$config->httpHosts = array('192.168.1.2');

/**
 * CPTECH CONFIGURATION
 *
 */
$config->rootURL = $rootURL;
$config->urls->vendor = "vendor/";
$config->urls->content = "$siteDir/templates/content/";
$config->paths = clone $config->urls;
$config->paths->root = $rootPath . '/';
$config->paths->sessions = $config->paths->assets . "sessions/";

$config->dplusdbname = "dpluso";
$config->cgis = array(
	'default' => 'DPLUSO3',
	'whse' => 'DPLUSOWAREHOUSE3'
);
$config->cptechcustomer = 'cptech';
$config->COMPANYNBR = '3';
$config->companyfiles = "/var/www/html/data$config->COMPANYNBR/";
$config->documentstorage = "/orderfiles/";
$config->documentstoragedirectory = "/var/www/html/orderfiles/";
$config->jsonfilepath = "/var/www/html/files/json$config->COMPANYNBR/";
$config->directory = "";
$config->imagedirectory = '/img/product/';
$config->imagefiledirectory  = '/var/www/html/img/product/';
