<?php
/**
 * This Versions controller updates the versions view and manipulates
 * the Bible model.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class Versions extends Controller
{
  /**
   * @param {string} $name The user name to assign for this session
   */
  public function index($name = '')
  {

    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('versions/index', ['user' => $user]);
    }
    else
    {
      if(isset($name) && !empty($name))
      {
        // Fetch all the versions
        $this->view('versions/index');
      }
      else
      {
        $this->view('versions/index');
      }
    }
  }

  /**
   *
   */
  public function specific($name)
  {
    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('versions/specific', ['user' => $user]);
    }
    else
    {
      if(isset($name) && !empty($name))
      {
        // Fetch all the versions
        $this->view('versions/specific');
      }
      else
      {
        $this->view('versions/specific');
      }
    }
  }
}

?>
