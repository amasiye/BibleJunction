<?php
/**
 * The App class is the most essential class of the entire application. It is
 * responsible for the core functionality for the application.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class App
{
  protected $controller = 'home';
  protected $method = 'index';

  protected $params = array();

  protected $db;
  protected $conn;

  public function __construct()
  {
    global $locale;

    // Make a new connection to the database
    $this->db = new DbContext;
    $this->conn = $this->db->conn;

    $url = $this->parse_url();

    if(file_exists('app/' . $locale . '/controllers/' . $url[0] . '.php'))
    {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once 'app/' . $locale . '/controllers/' . $this->controller . '.php';

    # Instantiate our controller object and reassign controller var accordingly
    $this->controller = new $this->controller;

    if(isset($url[1]))
    {
      if(method_exists($this->controller, $url[1]))
      {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    # If the url isn't empty assign values else assign empty array
    $this->params = $url ? array_values($url) : array();

    call_user_func_array(array($this->controller, $this->method), $this->params);
  }

  /**
   * Breaks up url into an array of tokens.
   *
   * @return $url An array containing each part of the url.
   */
  public function parse_url()
  {
    if(isset($_GET['url']))
    {
      return $url = explode(
                            '/',
                            filter_var(
                                        rtrim($_GET['url'], '/'),
                                        FILTER_SANITIZE_URL
                                      )
                            );
    }
  }

  /**
   * Sets the location of the php header method.
   */
  public static function redirect($path)
  {
    header("Location: {$path}");
  }

  /**
   * Returns a string array countaining country names.
   */
  public static function get_country_names()
  {
    return file(BASEPATH . "includes/countries.txt");
  }
}

?>
