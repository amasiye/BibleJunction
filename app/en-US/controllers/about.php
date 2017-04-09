<?php
/**
 * The About controller updates the about & faith views.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package cineflow
 */
class About extends Controller
{
  /**
   * @param {string} $name The user name to assign for this session
   */
  public function index($name = '')
  {

    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('about/index', ['user' => $user]);
    }
    else
    {
      $this->view('about/index');
    }
  }

  public function faith()
  {
    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('about/index', ['user' => $user]);
    }
    else
    {
      $this->view('about/faith');
    }
  }
}

?>
