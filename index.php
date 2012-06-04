<?php
# urls work like this:
# example.com/<$section>/<$view>/<$detail>/

error_reporting(E_ALL);

global $section;
global $view;
global $detail;

# Set default section if there is no section specified
$section = 'home';  #default to home
$section_name = "home.";  #default to home
$view = '';
$view_name = '';
$detail = '';
$detail_name = '';

# Set the section name based on the requested file name.
$qstring = explode('/',$_SERVER['REQUEST_URI']);

array_shift($qstring); # move over to eliminate first blank entry

# if the url has a query string, such as a ?utm_source=... or similar, we pop that off and ignore it.
if ( strpos(end($qstring),"?") !== false){
	array_pop($qstring);
}


# process section
if ($qstring[0] != ''){
	# Set default for the $section variable if it has a value
	$section = $qstring[0];
	$section_name = $section.".";
} 

#process view
if (count($qstring) > 1 && $qstring[1] != ''){
	# Set default for the $view variable if it has a value
	$view = $qstring[1];
	$view_name = $view.".";
} 

#process detail
if (count($qstring) > 2 && $qstring[2] != ''){
	# Set default for the $detail variable if it has a value
	$detail = $qstring[2];
	$detail_name = $detail.".";
} 


#page content
$inc_file =  "pages/".$section_name.$view_name.$detail_name."inc.php";
# first, lets see if the file we're trying to include exists. if not, we're going to 404
if (!file_exists($inc_file)){
	# doesn't exist, so we include the 404 page
	# we also send a 404 header to properly error
	header("HTTP/1.0 404 Not Found");
	$inc_file = 'pages/404.inc.php';
} 	
# start page buffering. we include the actual page contents here, but buffer the output.
# this lets us capture variables defined now, but display the echoed/html contents futher down in this script	
ob_start();
include_once($inc_file);
$page_body = ob_get_clean();	


#nav fragment processing
# we try and pull in a nav file for the given section
$nav_file = 'navigation/'.$section.".inc.php";	
ob_start();


# nav fragment processing
# we try and pull in a nav file for the current $section
# if the PAGE_STYLE is full, we dont do this
# this lets us have pages that don't have the nav
$nav_file = 'navigation/'.$section.".inc.php";	
ob_start();

if (PAGE_STYLE !== 'full') {
	if (!file_exists($nav_file) || $inc_file == 'pages/404.inc.php' ){  #inclde fallback if its a 404 too
		echo "<!-- no nav fragment found, including fallback -->";
		include_once('navigation/default.inc.php');			
	}else {
		include_once($nav_file);
	} 
} else {
	echo "<!-- no nav fragment, full page -->";
}
$nav_fragment = ob_get_clean();
	
#do includes and print output
include_once("lib/includes/head.inc.php"); 
include_once("lib/includes/header.inc.php");  
print trim($nav_fragment);
print "<!-- $inc_file -->";
print trim($page_body);  # echo the page body
include_once("lib/includes/footer.inc.php");  
?>