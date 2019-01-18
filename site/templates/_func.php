<?php
	use Dplus\ProcessWire\DplusWire;
	use Dplus\Dpluso\ScreenFormatters\TableScreenMaker;
	use Purl\Url;

/**
 * Shared functions used by the beginner profile
 *
 * This file is included by the _init.php file, and is here just as an example.
 * You could place these functions in the _init.php file if you prefer, but keeping
 * them in this separate file is a better practice.
 *
 */

/**
 * Given a group of pages, render a simple <ul> navigation
 *
 * This is here to demonstrate an example of a simple shared function.
 * Usage is completely optional.
 *
 * @param PageArray $items
 *
 */
function renderNav(PageArray $items) {

	if(!$items->count()) return;

	echo "<ul class='nav' role='navigation'>";

	// cycle through all the items
	foreach($items as $item) {

		// render markup for each navigation item as an <li>
		if($item->id == wire('page')->id) {
			// if current item is the same as the page being viewed, add a "current" class to it
			echo "<li class='current' aria-current='true'>";
		} else {
			// otherwise just a regular list item
			echo "<li>";
		}

		// markup for the link
		echo "<a href='$item->url'>$item->title</a> ";

		// if the item has summary text, include that too
		if($item->summary) echo "<div class='summary'>$item->summary</div>";

		// close the list item
		echo "</li>";
	}

	echo "</ul>";
}


/**
 * Given a group of pages render a tree of navigation
 *
 * @param Page|PageArray $items Page to start the navigation tree from or pages to render
 * @param int $maxDepth How many levels of navigation below current should it go?
 *
 */
function renderNavTree($items, $maxDepth = 3) {

	// if we've been given just one item, convert it to an array of items
	if($items instanceof Page) $items = array($items);

	// if there aren't any items to output, exit now
	if(!count($items)) return;

	// $out is where we store the markup we are creating in this function
	// start our <ul> markup
	echo "<ul class='nav nav-tree' role='navigation'>";

	// cycle through all the items
	foreach($items as $item) {

		// markup for the list item...
		// if current item is the same as the page being viewed, add a "current" class and
		// visually hidden text for screen readers to it
		if($item->id == wire('page')->id) {
			echo "<li class='current' aria-current='true'><span class='visually-hidden'>Current page: </span>";
		} else {
			echo "<li>";
		}

		// markup for the link
		echo "<a href='$item->url'>$item->title</a>";

		// if the item has children and we're allowed to output tree navigation (maxDepth)
		// then call this same function again for the item's children
		if($item->hasChildren() && $maxDepth) {
			renderNavTree($item->children, $maxDepth-1);
		}

		// close the list item
		echo "</li>";
	}

	// end our <ul> markup
	echo "</ul>";
}

function hash_templatefile($filename) {
	$hash = hash_file(Processwire\wire('config')->userAuthHashType, Processwire\wire('config')->paths->templates.$filename);
	return Processwire\wire('config')->urls->templates.$filename.'?v='.$hash;
}

/* =============================================================
   URL FUNCTIONS
 ============================================================ */
	 function get_localhostURL($path) {
		 $config = DplusWire::wire('config');
		 $url = new Url('127.0.0.1');

		 // IF the path provided contains the httpd directory path
		 if (strpos($path, $config->directory_httpd) !== false) {
			 $url->path = $path;
		 } else {
			 $url->path = $config->directory_httpd . $path;
		 }
		 return $url->getUrl();
	 }

 /* =============================================================
   FILE FUNCTIONS
 ============================================================ */
	 /**
	 * Writes an array one datem per line into the dplus directory
	 * @param  array $data      Array of Lines for the request
	 * @param  string $filename What to name File
	 * @return void
	 */
	function write_dplusfile($data, $filename) {
		$file = '';
		foreach ($data as $line) {
			$file .= $line . "\n";
		}
		$vard = "/usr/capsys/ecomm/" . $filename;
		$handle = fopen($vard, "w") or die("cant open file");
		fwrite($handle, $file);
		fclose($handle);
	}

	function curl_redir($url) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_FOLLOWLOCATION => true
		));
		return curl_exec($curl);
	}
