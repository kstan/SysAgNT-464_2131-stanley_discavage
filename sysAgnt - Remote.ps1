#Windows Testing Environment set up , Windows 7 and Server 2012 (acting as Domain Controller)


$Logfile = "C:\Users\Administrator\Desktop\GitHub\SysAgNT-464_2131-stanley_discavage\sysAgntRemote.log"

#Function to write to logfile.
Function writeLog
{
   Param ([string]$logstring)
   Add-content $Logfile -value $logstring
}


$computerlist = Get-Content Hostnames.txt

foreach ($computer in $computerlist)
{

#if (!([system.io.directory]::Exists(C:\Users\SysAgNT\site\Dropbox\site\data\$computer)))
#{
 #  [system.io.directory]::CreateDirectory((C:\Users\SysAgNT\site\Dropbox\site\data\$computer))
 #}
 
 $check = Test-Path -PathType Container C:\Users\SysAgNT\site\Dropbox\site\data\$computer
if($check -eq $false){
    New-Item "C:\Users\SysAgNT\site\Dropbox\site\data\$computer" -type Directory
}

$usrName = invoke-command -computername $computer {$env:username}
writeLog ("Username|$usrName")

$OSname = invoke-command -computername $computer {(Get-WmiObject Win32_OperatingSystem).Name}
$Architecture = invoke-command -computername $computer {(Get-WmiObject Win32_OperatingSystem).OSArchitecture}

writeLog("OS Name|$OSname")
writeLog("OS Architecture|$Architecture")



$computerName = invoke-command -computername $computer {$env:COMPUTERNAME} #Gets computer name from ENV variable
$date = invoke-command -computername $computer {Get-Date -format u} #Gets date.
$datename = invoke-command -computername $computer {(get-date).tostring("MMddyyyyHHmmss")}


writeLog("Computer Name|$computerName")
writeLog("Current Time|$date")


#Prints above information formatted with comma as delimiter
#writes user name, OS name, 32 or 64 bit, computer name, date and time to file 
#writeLog("List of info: $usrName,$OSname,$Architecture,$computerName,$date")


[string]$newtemp = ""
[int]$num = 0
invoke-command -computername $computer {Get-Process | Select-Object name} | Foreach { 
	
	
	
	[string]$procrun = "$_" 
	#adds each process appending to a string with comma as delimiter and new line at end of stirng
	[string]$procrun1 = $procrun.trim("@{Name=")
	[string]$procposition = $procrun1.IndexOf(";") #finds position of semicolon in list of processes
	[string]$process = $procrun1.substring(0, $procposition)
	[string]$proclist = $proclist + $process + ","	
	}
	
	writeLog ("Processes|$proclist")
	

	invoke-command -computername $computer {Get-WmiObject -Class win32_Product | Select-Object name} | Foreach {   #adds each application appending it to a string with a comma as a delimiter and new line at end of string
	[string]$apprun = "$_"
	[string]$apprun1 = $apprun.trimstart("@{name=")
	[string]$applposition = $apprun1.IndexOf(";")
	[string]$apprun2 = $apprun1.substring(0, $applposition)
	[string]$applist = $applist + $apprun2 + ","
	
	}
	writeLog("Applications|$applist")
	
	
Rename-Item "C:\Users\Administrator\Desktop\GitHub\SysAgNT-464_2131-stanley_discavage\sysAgntRemote.log" "C:\Users\Administrator\Desktop\GitHub\SysAgNT-464_2131-stanley_discavage\$datename.log"

Move-Item "C:\Users\Administrator\Desktop\GitHub\SysAgNT-464_2131-stanley_discavage\$datename.log"  "C:\Users\SysAgNT\site\Dropbox\site\data\$computer\$datename.log"
}