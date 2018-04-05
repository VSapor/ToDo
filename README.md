# ToDo
PHP Sample ToDo project. Run on localhost.

ToDo Project Main Components:
  I.   Reources
  II.  Tasks
  III. Budget

Component Functionality:

I. Resource:
  1. Search
  2. Add
  3. Delete
  4. Update

II. Task:
  TBD
  
III.
  TBD
	
SQL Databases:

I. ToDo
	
	Tables:
	
	1. resources: 
  
	Structure:
		#	Name	              Type	
		1	id (primary)	      int(11)		AUTO_INCREMENT	PRIMARY KEY
		2	first_name	        varchar(20)
		3	last_name	          varchar(20)
		4	pct_avail	          decimal(3,2)
		5	unavail_date_start	date
		6	unavail_date_end	  date
		7	skill	              varchar(15)
		8	daily_rate	        decimal(5,2)
		9 notes               text(100)
	
	2. budget:
	Structure: TBD
	
	3. tasks:
	Structure:
		#	Name		Type	
		1	idPrimary	int(11)		AUTO_INCREMENT	PRIMARY KEY	
		2	name		varchar(100)			
		3	priority	int(11)		
		4	duration	decimal(5,2)			
		5	start_by_date	date			
		6	end_by_date	date			
		7	real_start_date	date			
		8	real_end_date	date			
		9	status		varchar(15)			
		10	successorID	int(11)			
		11	notes		text
	
	4. JNCT_Resources_Tasks - Junction table to establish many/many relationship between RESOURCES and TASKS
	Structure:
		#	Name			Type
		1 	Resources_Tasks_ID	int(11) AUTO_INCREMENT	PRIMARY KEY
		2	Resource_FK		int(11)			FOREIGN KEY for RESOURCES
		3	Task_FK			int(11)			FOREIGN KEY for TASKS
		
	
	
Notes:

3/14/18:
	So far I have "completed" the code to provide all the specfied functionality: SEARCH, ADD, DELETE, UPDATE including user interfaces.
	Code is exclusively PHP and HTML. I have tried to keep HTML and PHP separate where I could. However, there are exceptions where I
	could not figure out how to implement the functionality without combining. I've tried to logically break code into components. I 
	was trying to reuse code but, again due to my limited knowledge, trying to reuse code was messy and made things more confusing.
	As a result, some scripts/pages seem redundant. If I had more knowledge of JavaScript or SQLJ, for example, I probably could have
	made some of the components more efficient/elegant. 
	
	I've done a fair amount of debugging but by no means exhaustive at this stage. 
	
	Known problems:
	
	1. I do not know how to present a new page for each new page. For example, when the user is on the RESOURCE SEARCH criteria screen and 			SUBMITs, the results are presented on the same screen. 
	2. On pages where there is data populated/posted, I do not know how to present error/warning messages while presenting the same
		 page. Instead, I had to resort to calling an ERROR page and presenting it with a link back to the nav screen. For example, 
		 if a user is on the RESOURCE SEARCH results screen within the DELETE function where he can choose which records to delete, if he
		 SUBMITs w/o selecting any records, instead of a message being presented on the same screen or simply redisplaying the page (no
		 action), they are taken to a warning page with a message NO RECORDS SELECTED. Similarly, on the DELETE and UPDATE CONFIRMATION
		 page where the user is presented with a radio button Y/N to confirm delete, if they click SUBMIT without make a Y/N choice 
		 the DELETE/UPDATE is cancelled and a message screen presented. In practice, this is not how it should be handled. But again, 
		 I could not figure out how to handle it using PHP alone. 
	3. In the same vein, when the message screen is presented and the user tries to use the BACK button, they are presented with an 
		 error screen with the following message:
				 Confirm Form Resubmission
						This webpage requires data that you entered earlier in order to be properly displayed. 
						You can send this data again, but by doing so you will repeat any action this page 
						previously performed.
						Press the reload button to resubmit the data needed to load the page.
						ERR_CACHE_MISS
						
4/6/18 Added new functionality:

Resource: Show assigned tasks
Projects: Show project tree diagram with dependencies

Questions:
1. How to handle mult. recs. selected in UPDATE function. Issue error message and exit???

2. In RESOURCES/VIEWS/SEARCH results.php : 
a. Tried to use "onclick" with href??
b. Added logic to make results array multi-dimentional to capture all rows for Update function

3. In views/resource/search/form.php

a. added flash message at top for delete/update canceled and for update mult. recs. selected
b. italic not showing
style="text-align: center; font-style: italic;  color: red;"

<p> style="text-align: center; font-style: italic;  color: red;">
        <?php echo flash_message(); ?>
</p>

4. In views/update.php - Added if ISSET in input fields to reshow fields on click

5. removed interactive tests/variables. always show checkboxes

6. How to clear our SESSION data?

7. created functions for search for match for update and for build where clause for

8. Project folder: results - resolving 0 in case? resolving 0 in function 'build where clause'

9. printtree - not printing title

10. assignedtasksTPL file / assignedtasksresults - Table formatting; fitted cell sizes ???

11. in tasksassignedresults don't know how to test for empty results because of multi-dimensional array always returns. TRUE. Added Logic in SHOWTASKS to test number of rows and set results = null if no rows found??

12. in search/index added logic for page submitted w/o selecting record. issue error message and return to search home???

13. How to show search results on new page? 
	
	
	
	
	
  
