RevoSSL is a plugin that will allow you to secure (make SSL) the Manager and any web page that you would like to have secure.
Installation Instructions

Install via the MODX Revolution package management

To Secure the Manager:

Go to System -> System Settings Look for revoSSL.manager (if it is not there then create it) and set it to YesTo create Setting:  
  Key: revoSSL.manager   Name: Secure the Manger 
  Field Type: Yes/No
  Value: Yes
  Description: If you select Yes then it will force all manager pages to be SSL.

Now open up a new tab and go to your manager and verify that it worked.  If it did not work or if you don't have SSL on your server you can still go back to your original tab and then set the value to No.

To Secure a web page:

Create a TV with the following values:
  General Info Tab:    
  Variable Name: makeSSL   
  Caption: Make page SSL    
  Description: If you select Yes this page will be forced to be SSL
Input Options Tab:   
  Input Type: Listbox(Single-Select)    
  Input Option Values: Yes==1||No==0     
  Default Value: 0
Now add the TV to all templates that you wish to have this option for.
Save your TV
Clear site cache Site -> Clear Cache
Test some pages!
