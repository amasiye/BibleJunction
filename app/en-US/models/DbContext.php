<?php

/**
 * This class is responsible for establishing a connection with the
 * the database.
 */
class DbContext
{
  public $conn;
  private static $__instance = null;
  private $db_host;
  private $db_user;
  private $db_pass;
  private $db_name;

  function __construct()
  {
    global $db_host, $db_user, $db_pass, $db_name;
    
    $this->db_host = $db_host;
    $this->db_user = $db_user;
    $this->db_pass = $db_pass;
    $this->db_name = $db_name;

    $this->conn = new mysqli(
                              $this->db_host,
                              $this->db_user,
                              $this->db_pass,
                              $this->db_name
                            );
  }

  public static function get_instance() {}

  /**
   * This is a wrapper method for the mysqli class' query method.
   *
   * @param {string} $query_str The SQL query string.
   * @return The results of the query or -1 if the string passed was an empty string.
   */
  public function query($query_str)
  {
    if(!empty($query_str))
    {
      return $this->conn->query($query_str);
    }
    else
    {
      return -1;
    }
  } // end query()

  /**
   * 
   */
  public function select($table, $params = [])
  {
      $columns = ( key_exists('columns', $params) && !empty($params['columns']) )? $params['columns'] : "*";
      $query = "SELECT {$columns}";

      if( key_exists('where', $params) && !empty($params['where']) )
      $query .= " WHERE " . $params['where'];

  } // end select()

  public function insert($table, $params) {} // end insert()
  public function update($table, $params = []) {} // end insert()
  public function delete($table, $params = []) {} // end insert()

} // end DbContext
?>