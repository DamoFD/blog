<?php
/*
#-----------------------------------------
| WebAnalytics: Settings
| https://webanalytics.one
#-----------------------------------------
| made by beranek1
| https://github.com/beranek1
#-----------------------------------------
*/

$web_analytics_db = new web_db_manager("mysql:dbname=" . DBNAME . ";host=" . DBHOST, DBUSER, DBPASS);
$web_auto_run = TRUE;