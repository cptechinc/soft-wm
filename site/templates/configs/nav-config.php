<?php
	$config->pages->index = $config->urls->root;
	$config->pages->account = $config->urls->root . 'user/account/';
	$config->pages->login = $config->urls->root . 'user/account/login/';
	$config->pages->warehouse = $config->urls->root . "warehouse/";
	$config->pages->warehousepicking = $config->urls->root . "warehouse/picking/";
	$config->pages->salesorderpicking = $config->urls->root . "warehouse/picking/pick-order/";
	$config->pages->salesorderpickpacking = $config->urls->root . "warehouse/picking/pick-pack/";
	$config->pages->menu_binr = $config->urls->root . "warehouse/binr/";
	$config->pages->binr = $config->urls->root . "warehouse/binr/binr/";
	$config->pages->menu_inventory = $config->urls->root . "warehouse/inventory/";
	$config->pages->inventory_physicalcount = $config->urls->root . "warehouse/inventory/physical-count/";
