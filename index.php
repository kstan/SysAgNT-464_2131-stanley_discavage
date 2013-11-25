<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	include 'utils.php';

	// Include Header
	echo Utils::includeHeader($pageTitle="Home");

	// Create List of Computers
	$computerList = array("SYSAGNT-CLIENT1", "SYSAGNT-CLIENT2", "SYSAGNT-CLIENT3");

	// Print info for each computer.
	foreach ($computerList as $computer)
	{
		echo $computer;
		echo Utils::getInfo($computer=$computer);
	}

	// Include Footer
	echo Utils::includeFooter();


?>