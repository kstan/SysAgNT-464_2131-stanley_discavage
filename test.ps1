#Gets computer name from first argument
$computerName = $args[0]

write-host $computerName

write-host("List of processes:")
[string]$newtemp = ""
[int]$num = 0
Invoke-Command -ComputerName $computerName {ps} | Select-Object name | Foreach 
{ 
	[string]$procrun = "$_"       #adds each process appending to a string with comma as delimiter and new line at end of stirng
	[string]$procrun1 = $procrun.trim("@{Name=")
	[string]$process = $procrun1.trimend("}")
	[string]$proclist = $proclist + $process + ","
}

write-host("Let's see if this works: $proclist")
write-host("List of applications")
