#Windows Testing Environment set up , Windows 7 and Server 2012 (acting as Domain Controller)


$Logfile = "sysAgnt.log"
$nl = [System.Environment]::NewLine

#$content = $content.Replace( $nl, "," )
#Function to write to logfile.
Function writeLog
{
   Param ([string]$logstring)
   #$logstring.Replace($nl, ",")
   Add-content $Logfile -value $logstring
}


$usrName = $env:username
writeLog ("User name is: $usrName")

$OSname = (Get-WmiObject Win32_OperatingSystem).Name
$Architecture = (Get-WmiObject Win32_OperatingSystem).OSArchitecture

writeLog ("OS Name is: $OSname")
writeLog ("OS Architecture is: $Architecture")



$computerName = $env:COMPUTERNAME #Gets computer name from ENV variable
$date = Get-Date #Gets date.
#$apps = Get-WmiObject -Class win32_Product | Select-Object name  #get list of apps

writeLog("Name of computer: $computerName")
writeLog("Current Time: $date")
writeLog("List of processes:")
Get-Process | Select-Object name | Foreach { 
	
	[string]$tempstring = "$_"
	Write-Host "1" #Testing to see if writing to output
	$newtemp = $tempstring -replace ([System.Environment]::NewLine, ",")
	Write-Host "2"
	#Write-Host $nl
	#Write-Host $newtemp
	writeLog("$newtemp")
	Write-Host "3"
	#Write-Host $tempstring
	#Write-Host $nl
	#writeLog($tempstring)

	} #.Replace('\r\n', ","))} #loop through all the processes and write each one to log
writeLog("List of applications")
Get-WmiObject -Class win32_Product | Select-Object name | Foreach { writeLog("$_")} #loop through all the software and write each one to log
writeLog(",")
writeLog("End of logfile.")

