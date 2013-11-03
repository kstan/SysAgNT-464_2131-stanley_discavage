$Logfile = "sysAgnt.log"
#Function to write to logfile.
Function writeLog
{
   Param ([string]$logstring)
   Add-content $Logfile -value $logstring
}

$computerName = $env:COMPUTERNAME #Gets computer name from ENV variable
$date = Get-Date #Gets date.

writeLog("Name of computer: $computerName")
writeLog("Current Time: $date")
writeLog("List of processes:")
Get-Process | Select-Object name | Foreach { writeLog("$_")} #loop through all the processes and write each one to log
writeLog("End of logfile.")