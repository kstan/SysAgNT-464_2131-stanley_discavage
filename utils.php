<?php


class Utils
{
	// Name: includeHeader()
	// Purpose: includes HTML header
	// Parameters: pageTitle, styleLink, onLoad
	// Returns: string with HTML header
	static function includeHeader($pageTitle="", $styleLink="styles/main.css", $onLoad="")
	{
		$website="SysAgNT";
		$header="
		<!DOCTYPE html>
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
			<meta http-equiv='content-type' content='text/html; charset=utf-8' />
			<title>$website: $pageTitle</title>
			<link type='text/css' rel='stylesheet' href='$styleLink' />
		</head>
		<body onload='$onLoad'>
		";

		return $header;
	}

	// Name: includeFooter()
	// Purpose: includes HTML footer
	// Parameters: 
	// Returns: string with HTML footer
	static function includeFooter()
	{
		$footer="
		</body>
		</html>";

		return $footer;
	}

	// Name: includeNav()
	// Purpose: includes navigation bar and title
	// Parameters: 
	// Returns: string with navigation
	static function includeNav()
	{
		$nav = "
			<div class='divTitle'>
				<h1 id='title'>SysAgNT</h1>
			</div>
			<div id='nav'>
				<ul class='menu'>
					<li><a href='index.php?page=Home'>Home</a></li>
					<li><a href='index.php?page=ComputerList'>Computer List</a></li>
					<li><a href='index.php?page=About'>About</a></li>
				</ul>
		</div>
		";
		return $nav;
	}

	// Name: printAbout()
	// Purpose: prints About text file
	// Parameters: 
	// Returns: nothing
	static function printAbout()
	{
		$about = file("about.txt");

		foreach ($about as $line_num => $line)
		{
			$aboutText = $line;
		}

		print "<p>$aboutText</p>";
	}

	// Name: getComputerList
	// Purpose: prints and gets list of computers from data folder
	// Parameters: 
	// Returns: array of computers
	static function getComputerList()
	{
		$path = 'data';
		$computerList = array();

		//itnerates through dirctory and finds directories
		foreach (new DirectoryIterator($path) as $file)
		{
			if($file->isDot()) continue; // is a file
			if($file->isDir()) // is a directory
			{
				$computerList[] = $file->getFilename(); //adds to array of computers
			}
		}

		print "<ul id='computerList'>"; //starts unordered list
		foreach ($computerList as $computer)
		{
			print "<li><a href='index.php?page=ComputerList&computer=$computer'>$computer</a></li>";
		}
		print "</ul>"; //ends unordered list

		return $computerList;
	}

	// Name: getLogList()
	// Purpose: prints list of logs inside computer folder
	// Parameters: $computerName
	// Returns: nothing
	static function getLogList($computerName="")
	{
		$path = "data/$computerName";
		$logList = array();
		//itnerates through dirctory and fines directories
		foreach (new DirectoryIterator($path) as $file)
		{
			if ($file->getFilename() != "." && $file->getFilename() != "..") //strips out .. and .
			{
				$logList[] = $file->getFilename(); //adds to array of computers
			}
		}
		print "<ul id='logList'>";
		foreach ($logList as $log)
		{
			print "<li><a href='index.php?page=ComputerList&computer=$computerName&date=$log'>$log</a></li>";
		}
		print "</ul>";

	}

	// Name: getData()
	// Purpose: gathers, organizes, and prints data from logfile
	// Parameters: $computerName and $logName
	// Returns: nothing
	static function getData($computerName="",$logName="")
	{
		$file = file("data/$computerName/$logName");

		$computer = array
		(
			"Username" => "",
			"OS Name" => "",
			"OS Architecture" => "",
			"Computer Name" => "",
			"Log Time" => "",
			"Processes" => "",
			"Applications" => ""
		);

		//Separates Data into Nice Array

		$username = explode('|', $file[0]); //seperates username
		$username[1] = trim(preg_replace('/\s+/', ' ', $username[1])); //removes newlines
		$computer["Username"] = $username[1]; //adds username to array

		$osName = explode('|', $file[1]); //separates OS Name
		$osName[1] = trim(preg_replace('/\s+/', ' ', $osName[1])); //removes newlines
		$computer["OS Name"] = $osName[1]; //adds OS Name to Array

		$osArc = explode('|', $file[2]); //separates OS Name
		$osArc[1] = trim(preg_replace('/\s+/', ' ', $osArc[1])); //removes newlines
		$computer["OS Architecture"] = $osArc[1]; //adds OS Arch to Array

		$computerName = explode('|', $file[3]); //separates Computer Name
		$computerName[1] = trim(preg_replace('/\s+/', ' ', $computerName[1])); //removes newlines
		$computer["Computer Name"] = $computerName[1]; //adds Computer Name to Array

		$currentTime = explode('|', $file[4]); //separates Log Time
		$currentTime[1] = trim(preg_replace('/\s+/', ' ', $currentTime[1])); //removes newlines
		$computer["Log Time"] = $currentTime[1]; //adds Log Time to Array

		$processes = explode('|', $file[5]); //separates Computer Name
		$processes = explode(',', $processes[1]);
		$blank = array_pop($processes); //removes blank
		$computer["Processes"] = $processes; //adds processes to Array


		$applications = explode('|', $file[6]); //separates Computer Name
		$applications = explode(',', $applications[1]);
		$blank = array_pop($applications); //removes blank
		$computer["Applications"] = $applications; //adds applications to Array

		print "<div class='computerInfo'>";
		print "<h3 class='computerTitle'>" . $computer["Username"] . " @ " . $computer["Computer Name"] . "</h3>";
		print "<h4 class='computerType'>" . $computer["OS Name"] . " " . $computer['OS Architecture'] . "</h4>";
		print "<h4 class='computerType'>" . "Log Time: " . $computer["Log Time"] . "</h4>";
		print "<h5 class='processesTitle'>" . "Proccesses" . "</h5>";
		print "<ul class='longList'>";
		foreach ($computer["Processes"] as $process)
		{
			print "<li class='longList'>$process</li>";
		}		
		print "</ul>";
		print "<h5 class='processesTitle'>" . "Applications" . "</h5>";
		print "<ul class='longList'>";
		foreach ($computer["Applications"] as $app)
		{
			print "<li class='longList'>$app</li>";
		}		
		print "</ul>";

		print "</div>";
	}


}

?>