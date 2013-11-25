<?php


class Utils
{
	// Name: includeHeader()
	// Purpose: includes HTML header
	// Parameters: 
	// Returns: string with HTML header
	static function includeHeader($pageTitle="", $styleLink="", $onLoad="")
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

	static function getInfo($computer="")
	{
		$cmd = "Invoke-Command -ComputerName $computer {ps}";
		$output = shell_exec("powershell -command $cmd");
		echo('<pre>');
		echo($output);
		echo('</pre>');
		$cmd = "Invoke-Command -ComputerName $computer {Get-WmiObject -Class win32_Product}";
		$output = shell_exec("powershell -command $cmd");
		echo('<pre>');
		echo($output);
		echo('</pre>');
		$cmd = "Invoke-Command -ComputerName $computer {(Get-WmiObject Win32_OperatingSystem).Name}";
		$output = shell_exec("powershell -command $cmd");
		echo('<pre>');
		echo($output);
		echo('</pre>');
		$cmd = "Invoke-Command -ComputerName $computer {(Get-WmiObject Win32_OperatingSystem).OSArchitecture}";
		$output = shell_exec("powershell -command $cmd");
		echo('<pre>');
		echo($output);
		echo('</pre>');
	}
}

?>