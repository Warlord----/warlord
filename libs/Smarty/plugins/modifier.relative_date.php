<?php

/*
* Smarty plugin
* -------------------------------------------------------------
* Type:     modifier
* Name:     relative_date
* Version:  1.1
* Date:     November 28, 2012
* Author:   Warlord
* Purpose:  Output dates relative to the current time
* Input:    
*           days = use date only and ignore the time
*           format = (optional) a php date format (for dates over 1 year)
* -------------------------------------------------------------
*/

function smarty_modifier_relative_date($timestamp, $days = false, $format = "M j, Y") {
  /*$class = get_class($model);
  $m = $class::find($model->id);
  
	$timestamp = $m->created_at;*/
  if (!is_numeric($timestamp)) {
    // It's not a time stamp, so try to convert it...
    $timestamp = strtotime($timestamp);
  }
  
  if (!is_numeric($timestamp)) {
    // If its still not numeric, the format is not valid
    return false;
  }
  
  // Calculate the difference in seconds
  $difference = time() - $timestamp;
  
  // Check if we only want to calculate based on the day
  if ($days && $difference < (60*60*24)) { 
    return smarty_modifier_t("Today"); 
  }
  if ($difference < 3) { 
    return smarty_modifier_t("Just now"); 
  }
  if ($difference < 60) {  
  	
  	if(getLastDigit($difference) == 1) 
  		return $difference . " " . smarty_modifier_t("secondu ago");
  	if(getLastDigit($difference) > 4) 
    	return $difference . " " . smarty_modifier_t("second ago"); 
    else return $difference . " " . smarty_modifier_t("seconds ago"); 
  }
  if ($difference < (60*2)) {    
    return smarty_modifier_t("1 minute ago"); 
  }
  if ($difference < (60*60)) { 
  	if(getLastDigit($difference / 60) == 1) 
  		return $difference . " " . smarty_modifier_t("minutu ago");
  	if(getLastDigit($difference / 60) >4) 
    	return intval($difference / 60) . " " . smarty_modifier_t("minute ago"); 
    else return intval($difference / 60) . " " . smarty_modifier_t("minutes ago"); 
  }
  if ($difference < (60*60*2)) { 
    return smarty_modifier_t("1 hour ago"); 
  }
  if ($difference < (60*60*24)) { 
  	if(getLastDigit($difference / 60*60) == 1) 
  		return $difference . " " . smarty_modifier_t("houru ago");
  	if(getLastDigit($difference / 60*60) >4)    
    	return intval($difference / (60*60)) . " " . smarty_modifier_t("hour ago"); 
    else return intval($difference / (60*60)) . " " . smarty_modifier_t("hours ago"); 
  }
  if ($difference < (60*60*24*2)) { 
    return "1 day ago"; 
  }
  if ($difference < (60*60*24*7)) {
  	if(getLastDigit($difference / 60*60*24) == 1) 
  		return $difference . " " . smarty_modifier_t("dayu ago"); 
  	if(getLastDigit($difference / 60*60*24) >4) 
    	return intval($difference / (60*60*24)) . " " . smarty_modifier_t("day ago"); 
    else return intval($difference / (60*60*24)) . " " . smarty_modifier_t("days ago"); 
  }
  if ($difference < (60*60*24*7*2)) { 
    return smarty_modifier_t("1 week ago"); 
  }
  if ($difference < (60*60*24*7*(52/12))) { 
  	if(getLastDigit($difference / 60*60*24*7) == 1) 
  		return $difference . " " . smarty_modifier_t("weeku ago"); 
  	if(getLastDigit($difference / 60*60*24*7) >4) 
    	return intval($difference / (60*60*24*7)) . " " . smarty_modifier_t("week ago"); 
    else return intval($difference / (60*60*24*7)) . " " . smarty_modifier_t("weeks ago"); 
  }
  if ($difference < (60*60*24*7*(52/12)*2)) { 
    return  smarty_modifier_t("1 month ago"); 
  }
  if ($difference < (60*60*24*364)) { 
  	if(getLastDigit($difference / (60*60*24*7*(52/12))) == 1) 
  		return $difference . " " . smarty_modifier_t("monthu ago"); 
  	if(getLastDigit($difference / (60*60*24*7*(52/12))) >4) 
    	return intval($difference / (60*60*24*7*(52/12))) . " " . smarty_modifier_t("month ago"); 
    else return intval($difference / (60*60*24*7*(52/12))) . " " . smarty_modifier_t("months ago"); 
  }
  
  // More than a year ago, just return the formatted date
  return @date($format, $timestamp);

}

function getlastDigit($n)
{
	while ($n > 20) {
		$n = $n%10;
	}
	return floor($n);
	
}

?>

