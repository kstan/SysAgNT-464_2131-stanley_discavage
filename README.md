SysAgNT
=======

Contributors: Kevin Stanley (kstan), Charles Discavage (csd2513)
License: GNU GPLv3
License URL: http://www.gnu.org/licenses/gpl.html
Requirements: Powershell

Description
============

SysAgNT is a Windows Profiler designed as an remote PowerShell script is is run on a series of systems.  This data is then viewable through a web interface.

The information it collects includes (currently):

applications/services on the system
services in use
who is logged into the system
OS type
OS architecture
computer name

To be added:
times system is typically on
times system is in use
times system is idle
times system is logged into

All this information is organized so that a profile of the system can be created to help system administrators
and IT professionals to better know when to run patches, secure the system and recognize suspicious activity.

Installation
============

For Clients:
In order to run remotely, the following should be done:
(open up Powershell as Administrator) and type
Enable-PSRemoting
(say Yes to all questions).
Also, ensure that the network type is set as "Work."  If it is set to anything else, it will not be able to run scripts remotely.
If the network type is already set, run the following in a script in order to set the network type back to "Work":
#/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$nlm = [Activator]::CreateInstance([Type]::GetTypeFromCLSID([Guid]"{DCB00C01-570F-4A9B-8D69-199FDBA5723B}"))
	$connections = $nlm.getnetworkconnections()
	$connections |foreach {
		if ($_.getnetwork().getcategory() -eq 0)
		{
			$_.getnetwork().setcategory(1)
		}
	}
#/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
If there is still trouble, the command "Set-WSManQuickConfig" can be run in PowerShell to setup remote settings.
	
For Server:
The server must be running PHP in order for the web interface to work.
Inside the root web folder the Powershell script creates a folder called "data."
This is where all the logs are stored.
Logs are organized by folder (computer name) and then the files are set as the date of when the log is run.

To Run Custom Powershell Commands:
Run Powershell as Administrator (right click, run as administrator)
Type following command in Powershell:
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned
If not run as administrator, there will be an error.

To setup SysAgNT to run every hour:
Search "Scheduled Tasks" and open.

