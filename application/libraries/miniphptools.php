<?php
class MiniPhpTools
{
  public $value_log = array();
  /**
   * Prints the value of $data
   * @param mix $data whatever you throw at the function
   * @param bool $var_dump_enabled determines the data type of $data
   * @param bool $is_die determines if the function calls die() or not
   * @return string
   */
  public function debug($data, $var_dump_enabled = false, $is_die = true)
  {
    $debug_data = '<pre>'.print_r($data, TRUE).'</pre>';

    if($var_dump_enabled == true)
      $debug_data = '<pre>'.print_r(var_dump($data), TRUE).'</pre>';

    if($is_die == true)
      die($debug_data);

    return $debug_data;
  }

  /**
   * Determines if request for a page is ajax or not.
   * @return boolean [true] to confirm an ajax request, [false] for vice versa.
   */
  public function is_ajax_request()
  {
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
      return true;
    else
      return false;
  }

  // for now, is unused.
  // retrieves the currently navigated url.
  public function url()
  {
    return sprintf(
      "%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
      $_SERVER['REQUEST_URI']
    );
  }

  /**
   * Creates an array of values logged by the developer.
   * Displays upon request by developer by providing [true] or [json] as a parameter.
   *
   * param1
   *   - (mix)     value - value of variable or constant being logged.
   *   - (boolean) true  - set only if developer wants to see trace of values so far.
   *   - (string)  json  - same function as above. Only that it sets the response type as a json.
   * param2
   *   - (string)  key   - index name of the value being logged
   */
  public function value_log()
  {
    $numargs = func_num_args();
    if($numargs == 2)
    {
      $value_log = $this->value_log;
      $value_log[func_get_arg(1)] = func_get_arg(0);
      $this->value_log = $value_log;
    }
    elseif($numargs == 1)
    {
      $single_arg = func_get_arg(0);

      if($single_arg === true)
        $this->debug($this->value_log);

      if($single_arg === 'json')
      {
        header('Content-type: application/json');
        echo json_encode($this->value_log);
        die();
      }
    }
  }

  /**
   * Conduct a single call curl transaction
   * @param  string  $url         postback url
   * @param  array   $fields      values you want to send
   * @param  boolean $return      what you want to be sent back, either [html] or [json]
   * @param  boolean $json_decode if you want the function to return a json data
   * @return string               response of the url called
   */
  public function curl($url, $fields, $return = false, $json_decode = false)
  {
    $data = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); # The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);        # The maximum number of seconds to allow cURL functions to execute.

    $result = curl_exec($ch);
    curl_close($ch);

    if($json_decode === true)
      $result = json_decode($result);

    if($return === true)
      return $result;

    echo $result;
  }




  /**
   * app-specific Custom tools
   */





  /**
   * ONLY use if a function conducts a DB transaction ONCE to save resources
   * @return object DB model
   */
  public static function model()
  {
    return new Model();
  }

  /**
   * Stops Flight as it returns a success message json data
   * @return string json data success message
   */
  public function success($message = '')
  {
    $message = $message === '' ? 1 : $message;
    Flight::json(array('success' => $message));
    Flight::stop();
  }

  /**
   * Stops Flight as it returns a fail message json data
   * @param  string $data detailed message why request failed
   * @return string       json data success message
   */
  public function fail($message = '')
  {
    $message = $message === '' ? 'someting went wrong' : $message;
    $data = array
    (
      'success' => 0,
      'message' => $message,
    );

    // Is the same as:
    // Flight::halt(200, Flight::json($data));
    Flight::json($data);
    Flight::stop();
  }

  public function render_stop($view_file)
  {
    Flight::render($view_file);
    Flight::stop();
  }
}
