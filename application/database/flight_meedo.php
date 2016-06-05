<?php
require_once('medoo.min.php');
require('application/config/database.php');

/**
 * MEEDO NOTES
 *
 * $columns can only be string if the value is one column or '*'. More than one column should be passed as an array.
 * examples:
 * $columns = 'date_created';
 * $columns = '*';
 * $columns = array('id', 'date_created', 'activity');
 */

Class flightMeedo
{
  public function __construct()
  {
    $this->table_name = null;               # table to be used by the database
    $this->db = new medoo([                 # call meedo and start interacting with the database
      'database_type' => 'mysql',
      'database_name' => Flight::get('database_name'),
      'server'        => Flight::get('server'),          # host
      'username'      => Flight::get('username'),
      'password'      => Flight::get('password'),
      'charset'       => Flight::get('charset'),

      // [optional]
      'port' => Flight::get('port'),

      // [optional] Table prefix
      // 'prefix' => 'PREFIX_',

      // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
      'option' => Flight::get('option')
    ]);
  }

  public function resource()
  {
    return $this->__construct();
  }

  /**
   * Set table to be used by functions
   * @param  string $data table name
   * @return string       table name being set to be used
   */
  public function use_table($data)
  {
    $this->table_name = $data;
  }

  /**
   * Execute raw queries
   * @param  string $data        query string
   * @param  boolean $return_data returns query result on [true]
   * @return object              query result
   */
  public function query($data, $return_data = false)
  {
    if($return_data == true)
      return $this->db->query($data)->fetchAll();
    else
      $this->db->query($data);
  }

  /**
   * Insert data to table
   * @param  array $values      array of values
   * @param  boolean $return_data returns query result on [true]
   * @return object              query result
   */
  public function create($values, $return_data = false, $debug = false)
  {
    $query = $this->db->insert($this->table_name, $values);

    if($debug === true)
      return $this->db->last_query();

    if($return_data == true)
      return $query;
  }

  public function read($where, $columns = '*', $join = null, $debug = false)
  {
    $data = $this->db->select($this->table_name, $columns, $where);
    if($debug === true)
      return $this->db->last_query();

    return $data;
  }

  public function read_all($columns = null, $debug = false)
  {
    if($columns === null)
    {
      $data = $this->db->select($this->table_name, '*');
      if($debug === true)
        return $this->db->last_query();
      return $data;
    }

    if($columns !== null)
    {
      $data = $this->db->select($this->table_name, $columns);
      if($debug === true)
        return $this->db->last_query();

      return $data;
    }
  }

  /**
   * Reads one row in the table.
   *
   * Provides first inserted record in the table if $where is null
   * @param  array $where   column and data to match
   * @param  mix $columns string/array
   * @return array          data record
   */
  public function read_one($where = array(), $columns = '*', $debug = false)
  {
    $data = $this->db->get($this->table_name, $columns, $where);
    if($debug === true)
      return $this->db->last_query();

    return $data;
  }

  public function count($where, $debug = false)
  {
    $data = $this->db->count($this->table_name, $where);
    if($debug === true)
      return $this->db->last_query();

    return $data;
  }

  /**
   * Updates row data on the table
   * @param  [type] $values      [description]
   * @param  boolean $return_data returns query result on [true]
   * @return object              query result
   */
  public function update($data, $where, $return_data = false, $debug = false)
  {
    $query = $this->db->update($this->table_name, $data, $where);
    if($debug === true)
      return $this->db->last_query();

    if($return_data == true)
      return $query;
  }

  /**
   * Deletes row data from the database
   * @param  [type] $where      [description]
   * @param  boolean $return_data returns query result on [true]
   * @return object              query result
   */
  public function delete($where, $return_data = false)
  {
    $query = $this->db->delete($this->table_name, $where);

    if($return_data == true)
      return $query;
  }

  public function  delete_one($id, $column_name = 'id', $return_data = false)
  {
    $where = array
    (
      $column_name => $id
    );
    $query = $this->db->delete($this->table_name, $where);

    if($return_data == true)
      return $query;
  }
}

?>
