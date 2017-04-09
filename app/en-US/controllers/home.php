<?php
/**
 * This home controller serves as the default controller. It updates the home
 * view as well as the help, advertise-with-us, support-us & newsletters views.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class Home extends Controller
{
  /**
   * @param {string} $name The user name to assign for this session
   */
  public function index($action = '')
  {

    if(user_is_logged_in())
    {
      $votd = Bible::get_votd();
      $user = $this->model('User');
      $this->view('home/index', array('user' => $user, 'votd'=>$votd));
    }
    else
    {
      if(isset($action) && !empty($action))
      {
        switch($action)
        {
          case "help":
            $this->view('home/help');
            break;

          case "advertise-with-us":
            $this->view('home/advertise');
            break;

          case "support-us":
            $this->view('home/support');
            break;

          case "newsletters":
            $this->view('home/newsletters');
            break;

          case "privacy-policy":
            $this->view('home/privacy');
            break;

          default:
            $votd = Bible::get_votd();
            $this->view('home/index', array('votd'=>$votd));
        }
      }
      else
      {
        $votd = Bible::get_votd();
        $this->view('home/index', array('votd'=>$votd));
      }
    }
  } // end index

  public function newsletters($action = "", $data=array())
  {
    if(user_is_logged_in)
    {
      $user = $this->model('User');

      switch ($action)
      {
        case 'subscribe':
          $this->view('home/subscribe', array('user' => $user));
          break;

        case 'thanks':
          $this->view('home/thanks');
          break;

        case 'error':
          $this->view('home/error', array('user' => $user));
          break;

        default:
          # code...
          break;
      }
    }
    else
    {
      switch ($action)
      {
        case 'subscribe':
          $this->view('home/subscribe');
          break;

        case 'error':

          $this->view('home/error');
          break;

        default:
          # code...
          break;
      }
    }
  } // end newsletters

}

?>
