<?php
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	include 'utils.php';

	// Sets Computer up to use
	if (isset($_GET['computer']))
		$computer = $_GET['computer'];
	
	// Sets Computer up to use
	if (isset($_GET['date']))
		$log = $_GET['date'];

	// Checks page
	$page = $_GET['page'];
	if ($page == "Home")
	{} #Do Nothing
	elseif ($page == "ComputerList")
	{} #Do Nothing
	elseif ($page == "About")
	{} #Do Nothing
	else
	{
		$page = "Home";
	}


	// Include Header
	echo Utils::includeHeader($pageTitle="Home");

	// Include Nav
	echo Utils::includeNav();

	/////////////////////////////////////////////////////////////////////////////////
	// Homepage Code ////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	if ($page == "Home")
	{
		print "<p>Logs have been last updated: " . date("F d Y H:i:s.", filemtime('data.')) . "</p>";
	}
	/////////////////////////////////////////////////////////////////////////////////
	// End Homepage Code ////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////
	
	/////////////////////////////////////////////////////////////////////////////////
	// Computer List Code ///////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	elseif ($page == "ComputerList")
	{

		$computerList = Utils::getComputerList();
		//print_r ($computerList);
		//Utils::getData($computer);

		//if computerName is set, show logs
		if (isset($_GET['computer']))
		{
			Utils::getLogList($computerName=$computer);
		}

		//if date is set, show logs
		if (isset($_GET['date']))
		{
			Utils::getData($computerName=$computer, $logName=$log);
		}

	}
	/////////////////////////////////////////////////////////////////////////////////
	// Computer List Code ////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////
	// About Code ///////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////
	elseif ($page == "About")
	{
		echo Utils::printAbout();
	}
	/////////////////////////////////////////////////////////////////////////////////
	// End About Code ///////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////

	// Include Footer
	echo Utils::includeFooter();

?>