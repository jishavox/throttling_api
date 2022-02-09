# throttling_api
 Implement a basic API throttling system which serves HTTP requests which a. Normally serves the requested resource b. Throttles requests from a REFERRER when the number of requests exceeds X/sec, where X is configurable.
 # Impliment Database
 import database from the folder /database
 2 tables ( user and api_token)
# user table 
 used to create basic API. GET data from table
 # api_token
 usedd to set authentication and hit limit (throttling) setting
 # Database configuration
  set username, password, database name
  /api/db.php
 # API Implementation
  In /api folder index.php 
  
  # API Token Configuration 
  You Can add/edit/ deactivate any hit limit, time limit and api token status from this link
   /api/api_config.php
   
  # API Call
  
  This API used to get data from the table ,
  Call the API url with API KEY
  /apicall/index.php
  
 # WAMP Implementation
 
 In PhpMyAdmin
 1. Create database
 2. Import Table
 
 # In WAMP project folder
 !---- API Creation---!
 1. Crate api folder
 2. copy all the files from /api and paste
 
 !----- API Call---!
 1. Crate apicall folder
 2.  2. copy all the files from /apicall and paste

# How to run 
!-- API Configuration -->
localhost/api/api_config.php

!-- API Call -->
localhost/apicall

You Can change api key from index.php -line no 5

 
 
