<?php
require_once('flight_meedo.php');

/**
 * Core interface for Simple queries such as CRUD transactions.
 * Refer to application/database/flight_meedo.php for more functions.
 *
 * For complex queries, use the 'fmeedo' tool.
 * 	example: Flight::fmeedo()->query($query, true); // when 'select'-ing data
 * 	example 2: Flight::fmeedo()->query($query); // when doing non-'select' queries
 */
Class Model
{
  public function __construct()
  {
    $this->fm = new flightMeedo();
  }

  private function set_table($table)
  {
    // 'fm' = flight medoo
    $this->fm->use_table($table);

    return $this->fm;
  }

  public function bl()
  {
    return $this->set_table('bio_log');
  }

  public function t()
  {
    return $this->set_table('timezones');
  }
}
?>
