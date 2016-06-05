<?php
require 'application/config/requirements.php';

Flight::set('flight.views.path', './application/views');

/**
 * note** use this to debug: Flight::tools()->debug($data);
 *        use this to debug with var_dump: Flight::tools()->debug($data, true);
 */
class search
{
  // public url functions <start>
  /**
   * The only function that will be called publicly.
   *
   * Params can't really be used in this framework. They are just present for reference.
   * Params will be used by using the get global variable
   * @param  mixed $ac_no  id
   * @param  string $from   date start
   * @param  string $to     date end
   * @param  string $update yes or no
   */
  public static function index($ac_no = '', $from = '', $to = '', $update = '')
  {
    self::update_bio_log_records();
    $where = self::where_query_builder();

    if(Flight::tools()->is_ajax_request() === true)
    {
      $data = Flight::tools()->model()->bl()->read($where);
      Flight::json(array('data' => $data));
    }
    else
      Flight::suffer_tools()->render_suffer_page();

    Flight::stop();
  }


  // public url functions <end>

  /**
   * Just update the records.
   * Warning: Could take a while to finish.
   */
  private static function update_bio_log_records()
  {
    if(Flight::request()->query->update_records == 'yes')
      Pages::update(true);
  }

  /**
   * build array understandable by meedo ORM to create a query
   * @return array built query understandable by meedo
   */
  private static function where_query_builder()
  {
    $ac_no = Flight::request()->query->ac_no;      # could be comma separated multiple numbers
    $from = Flight::request()->query->from_date;   # date start
    $to = Flight::request()->query->to_date;       # date end
    $order = Flight::request()->query->order;      # order pattern only. ex: ASC, DESC
    $ac_no_data = explode(',',str_replace(' ', '', $ac_no));
    $where = array(
      "AND" => array(
        "log_time[<>]" => array(
          $from,
          $to,
        ),
      ),
    );

    if($order == NULL)
      $where['ORDER'] = 'log_time ASC';
    else
      $where['ORDER'] = 'log_time '.$order;

    if(!empty($ac_no_data[0]))
      $where['AND']["ac_no"] = $ac_no_data;

    return $where;
  }
}
Flight::start();
?>
