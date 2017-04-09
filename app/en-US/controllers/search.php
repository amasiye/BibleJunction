<?php
/**
 * The Search controller manages all search interactions between the database
 * model and the search view.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class Search extends Controller
{
  /**
   * @param {string} $name The user name to assign for this session
   */
  public function index($name = '')
  {

    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('home/index', ['user' => $user]);
      // App::redirect(BASEPATH . 'browse/');
    }
    else
    {
      $this->view('search/index');
    }
  }
}

?>
