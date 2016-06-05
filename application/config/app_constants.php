<?php

  Flight::set('asset.path', Flight::app()->request()->base.'/assets/');

  // set application timezone
  $timezone_query_where = array('is_active' => 1);
  $timezone_query = Flight::tools()->model()->t()->read_one($timezone_query_where);
  if($timezone_query !== false)
    $current_timezone = $timezone_query['timezone'];
  
  date_default_timezone_set($current_timezone);

  // we have no use for this yet.
  // Flight::set('flight.base_url', 'http://localhost'.Flight::app()->request()->base);
?>
