<?php
require 'application/config/requirements.php';

Flight::set('flight.views.path', './application/views');

Class Pages
{
  /**
   * Will contain the login/logout page.
   * @return view page
   */
  public static function index()
  {

  }

  /**
   * updates the database record.
   * The record retrieved will be taken directly from the machine (ds100) to the database
   * @return none
   */
  public static function update($called_internally = false)
  {
    // zk process here
    $records = Flight::zklib()->process();
    Flight::tools()->model()->bl()->create($records, true);

    if($called_internally === false)
      Flight::json(array('done'));
    else
      return true;
  }

  /**
   * Random test pot
   */
  public static function test()
  {
    $query = "SELECT * FROM bio_log WHERE ac_no = '123' AND log_time BETWEEN '2016-02-09 20:00:00' AND '2016-02-10 07:00:59' ORDER BY log_time ASC";
    $data = Flight::fmeedo()->query($query, true);

    Flight::tools()->debug($data);
  }
}

Flight::start();
?>
