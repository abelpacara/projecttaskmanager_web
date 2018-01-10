<?php
function spanish_date_format_to_mysql($spanish_date)
{
	if(isset($spanish_date) AND strcasecmp(trim($spanish_date), "")!=0){
		list($day, $month, $year) = explode("/", $spanish_date);
    	return $year."-".$month."-".$day;
	}
	return "";    
}
function mysql_date_format_to_spanish($mysql_date){
	if(isset($mysql_date) AND strcasecmp(trim($mysql_date), "")!=0){
	    list($year, $month, $day) = explode("-", $mysql_date);
	    return $day."/".$month."/".$year;
 	}
 	return "";
}