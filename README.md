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
	
	
	
	
	
  

<br /><br /><br /><br />
Recommended new tasks table/structure
```
CREATE TABLE `tasks_new` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `task_project_id` int(11) NOT NULL,
  `task_parent` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `task_priority` int(11) NOT NULL COMMENT '5=Critical, 4=High, 3=Medium, 2=Low, 1=Optional',
  `task_duration` decimal(5,2) NOT NULL,
  `task_start_by_date` date NOT NULL,
  `task_end_by_date` date NOT NULL,
  `tasl_actual_start_date` date NOT NULL,
  `task_actual_end_date` date NOT NULL,
  `task_status` int(11) NOT NULL COMMENT '0=Not Scheduled, 1=Scheduled, 2=Started, 3=Completed, 4=Pending, 5=Canceled',
  `task_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks_new`
--

INSERT INTO `tasks_new` (`task_id`, `task_name`, `task_project_id`, `task_parent`, `task_priority`, `task_duration`, `task_start_by_date`, `task_end_by_date`, `tasl_actual_start_date`, `task_actual_end_date`, `task_status`, `task_notes`) VALUES
(101, 'Remove existing cabinets from basement kitchen.', 1000, 0, 1, '1.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, ''),
(102, 'Install new cabinets in basement kitchen', 1000, 0, 1, '1.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, ''),
(103, 'Remove existing kitchen sink from basement kitchen', 1000, 0, 2, '0.50', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, ''),
(104, 'Install new kitchen sink in basement kitchen', 1000, 0, 2, '0.50', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, ''),
(105, 'Install Split HV/AC unit in basement L/R and B/R', 2000, 0, 2, '1.00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', 0, ''),
(106, 'Install egress window in basement B/R', 3000, 0, 1, '3.00', '2018-02-26', '2018-02-28', '0000-00-00', '0000-00-00', 0, ''),
(107, 'Change light fixtures and GFI outlets in basement kitchen and utility room', 1000, 0, 1, '1.00', '2018-01-22', '2018-01-22', '2018-01-22', '2018-01-23', 0, ''),
(108, 'Purchase egress window', 3000, 0, 1, '0.25', '2018-02-12', '2018-02-23', '2018-02-12', '2018-02-20', 0, ''),
(109, 'Change outside light fixtures and GFI outlets.', 0, 0, 1, '1.00', '2018-01-23', '2018-01-23', '2018-01-26', '2018-01-26', 0, ''),
(1000, 'Parent Task 1', 10000, 0, 0, '1.00', '2019-01-01', '2019-01-02', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1100, 'Task 1000 Child 1', 10000, 1000, 0, '2.00', '2018-12-13', '2018-12-14', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1110, 'Task 1000 Grandchild 1', 10000, 1100, 0, '3.00', '2018-12-07', '2018-12-09', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1111, 'Task 1000 Great Grandchild 1', 10000, 1110, 0, '4.00', '2018-12-01', '2018-12-04', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1112, 'Task 1000 Great Grandchild 2', 10000, 1110, 0, '4.00', '2018-12-05', '2018-12-09', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1120, 'Task 1000 Grandchild 2', 10000, 1100, 0, '3.00', '2018-12-10', '2018-12-12', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1200, 'Task 1000 Child 2', 10000, 1000, 0, '2.00', '2018-12-18', '2018-12-19', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1210, 'Task 1000 Grandchild 3', 10000, 1200, 0, '3.00', '2018-12-15', '2018-12-17', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1211, 'Task 1000 Great Grandchild 3', 10000, 1210, 0, '4.00', '2018-12-10', '2018-12-14', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(1300, 'Task 1000 Child 3', 10000, 1000, 0, '2.00', '2018-12-29', '2018-12-30', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2000, 'Parent Task 2', 10000, 0, 0, '1.00', '2019-02-01', '2019-02-02', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2100, 'Task 2000 Child 1', 10000, 2000, 0, '2.00', '2019-01-08', '2019-01-09', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2110, 'Task 2000 Grandchild 1', 10000, 2100, 0, '3.00', '2019-01-05', '2019-01-07', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2111, 'Task 2000 Great Grandchild 1', 10000, 2110, 0, '4.00', '2019-01-01', '2019-01-04', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2120, 'Task 2000 Grandchild 2', 10000, 2100, 0, '3.00', '2019-01-01', '2019-01-03', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2200, 'Task 2000 Child 2', 10000, 2000, 0, '2.00', '2019-01-01', '2019-01-02', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2300, 'Task 2000 Child 3', 10000, 2000, 0, '2.00', '2019-01-19', '2019-01-20', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2310, 'Task 2000 Grandchild 3', 10000, 2300, 0, '3.00', '2019-01-13', '2019-01-15', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2311, 'Task 2000 Great Grandchild 2', 10000, 2310, 0, '4.00', '2019-01-05', '2019-01-08', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2312, 'Task 2000 Great Grandchild 3', 10000, 2310, 0, '0.00', '2019-01-09', '2019-01-12', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(2320, 'Task 2000 Grandchild 3', 10000, 2300, 0, '3.00', '2019-01-01', '2019-01-01', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3000, 'Parent Task 3', 10000, 0, 0, '1.00', '2019-03-01', '2019-03-02', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3100, 'Task 3000 Child 1', 10000, 3000, 0, '2.00', '2019-02-08', '2019-02-09', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3110, 'Task 3000 Grandchild 1', 10000, 3100, 0, '3.00', '2019-02-05', '2019-02-07', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3111, 'Task 3000 Great Grandchild 1', 10000, 3110, 0, '4.00', '2019-02-01', '2019-02-04', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3200, 'Task 3000 Child 2', 10000, 3000, 0, '2.00', '2019-02-12', '2019-02-13', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3210, 'Task 3000 Grandchild 2', 10000, 3200, 0, '3.00', '2019-02-09', '2019-02-11', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3211, 'Task 3000 Great Grandchild 2', 10000, 3210, 0, '4.00', '2019-02-05', '2019-02-08', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3220, 'Task 3000 Grandchild 3', 10000, 3210, 0, '3.00', '2019-02-13', '2019-02-15', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3221, 'Task 3000 Great Grandchild 3', 10000, 3220, 0, '4.00', '2019-02-12', '2019-02-16', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3230, 'Task 3000 Grandchild 4', 10000, 3200, 0, '3.00', '2019-02-17', '2019-02-19', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data'),
(3231, 'Task 3000 Great Grandchild 4', 10000, 3230, 0, '4.00', '2019-02-17', '2019-02-20', '0000-00-00', '0000-00-00', 0, 'Critical Path Test Data');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks_new`
--
ALTER TABLE `tasks_new`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks_new`
--
ALTER TABLE `tasks_new`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3232;COMMIT;

```