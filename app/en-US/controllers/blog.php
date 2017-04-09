<?php
/**
 * This class controls all home activity.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class Blog extends Controller
{
  /**
   * @param {string} $name The user name to assign for this session
   */
  public function index($name = '')
  {

    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('blog/index', ['user' => $user]);
      // App::redirect(BASEPATH . 'browse/');
    }
    else
    {
      $this->view('blog/index');
    }
  }
}

?>
