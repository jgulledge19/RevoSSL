--------------------
revoSSL
--------------------
Version: 1.0.4 pl
Since: May 5th, 2011
Updated: April 15, 2013
Author: Joshua Gulledge 
License: GNU GPLv2 (or later at your option)

RevoSSL is a plugin that will allow you to secure (make SSL) the Manager and 
any web page that you would like to have secure.  

NOTE: You can also set the Manager to SSL via Apache/Nginx rules. Which would be the preferred method. 
    If you use this method set the revoSSL.enableManager to No. Then you will not have infinite loops and still be able to set individual page to SSL. 

Install:
1. Install via the MODX Revolution package management

To Secure the Manager:
1. Go to System -> System Settings
2. Look for revoSSL.enableManager (if it is not there then create it) and set it to Yes
  Key: revoSSL.enableManager
  Name: Force Manger http(s)  
  Field Type: Yes/No
  Value: Yes
  Description: If you select Yes then it will force all manager pages to be http if revoSSL.manager is set to No and https if it is set to Yes.

3. Look for revoSSL.manager (if it is not there then create it) and set it to Yes
    To create Setting:
    Key: revoSSL.manager
    Name: Secure the Manger
    Field Type: Yes/No
    Value: Yes
    Description: If you select Yes then it will force all manager pages to be SSL.
    
4. Now open up a new tab and go to your manager and verify that it worked.  If it did not work or 
    if you don’t have SSL on your server you can still go back to your original tab and then set the value to No.

To Secure a web page:
1. Look for revoSSL.enableWeb (if it is not there then create it) and set it to Yes
  Key: revoSSL.enableWeb
  Name: Force Web http(s)  
  Field Type: Yes/No
  Value: Yes
  Description: If you select Yes then it will force all web pages to be either http or https based on the TV value in step number 2. If enabled will default will force all pages to http.
  
2. Create a TV with the following values:
    General Info Tab:
        Variable Name: makeSSL
        Caption: Make page SSL
        Description: If you select Yes this page will be forced to be SSL(https). NOTE: Default will force http
    Input Options Tab:
        Input Type: Listbox(Single-Select)
        Input Option Values: Yes==1||No==0
        Default Value: 0
3. Now add the TV to all templates that you wish to have this option for.
4. Save your TV
5. Clear site cache Site -> Clear Cache
6. Test some pages!

To force WWW: (disabled by default, preferred method would be a Apache/Nginx rule)
1. Go to System -> System Settings
2. Look for revoSSL.forceWWW (if it is not there then create it) and set it to Yes
    To create Setting:
    Key: revoSSL.forceWWW
    Name: Force WWW
    Field Type: Yes/No
    Value: 0
    Description: If set to Yes then it will force all pages to use www. So example.com becomes www.example.com. 


