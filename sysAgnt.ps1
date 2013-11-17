#Windows Testing Environment set up , Windows 7 and Server 2012 (acting as Domain Controller)


$Logfile = "sysAgnt.log"

#Function to write to logfile.
Function writeLog
{
   Param ([string]$logstring)
   Add-content $Logfile -value $logstring
}


$usrName = $env:username
writeLog ("User name is: $usrName")

$OSname = (Get-WmiObject Win32_OperatingSystem).Name
$Architecture = (Get-WmiObject Win32_OperatingSystem).OSArchitecture

writeLog("OS Name is: $OSname")
writeLog("OS Architecture is: $Architecture")



$computerName = $env:COMPUTERNAME #Gets computer name from ENV variable
$date = Get-Date #Gets date.
#$apps = Get-WmiObject -Class win32_Product | Select-Object name  #get list of apps

writeLog("Name of computer: $computerName")
writeLog("Current Time: $date")

#Prints above information formatted with comma as delimiter
#writes user name, OS name, 32 or 64 bit, computer name, date and time to file 
writeLog("List of info: $usrName,$OSname,$Architecture,$computerName,$date")

writeLog("List of processes:")
[string]$newtemp = ""
[int]$num = 0
Get-Process | Select-Object name | Foreach { 
	
	[string]$procrun = "$_"       #adds each process appending to a string with comma as delimiter and new line at end of stirng
	[string]$procrun1 = $procrun.trim("@{Name=")
	[string]$process = $procrun1.trimend("}")
	[string]$proclist = $proclist + $process + ","
	}
	
	writeLog ("Let's see if this works: $proclist")
	writeLog("List of applications")
Get-WmiObject -Class win32_Product | Select-Object name | Foreach {   #adds each application appending it to a string with a comma as a delimiter and new line at end of string
	[string]$apprun = "$_"
	[string]$apprun2 = $apprun.trimstart("@{name=")
	[string]$apprun3 = $apprun2.trimend("}")
	[string]$applist = $applist + $apprun3 + ","
	}
	writeLog("Let's see if this works: $applist")
	
	
writeLog("End of logfile.")

