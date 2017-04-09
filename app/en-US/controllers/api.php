<?php

/**
 * The Api controller handles all web service requests and provides an extensive
 * and robust api.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class Api extends Controller
{
  function index()
  {

  }

  /**
   * The "Verse of the day" endpoint.
   * @param $version The bible version/translation.
   * @return A JSON string containing status and "verse of the day" info.
   */
  function votd($version='web')
  {
    $votd = Bible::get_votd(array("timezone"=>"America/Halifax"));

    $ref = $votd['book'] . " " . $votd['chapter'] . ":" . $votd['verse'];
    $link = BASEPATH . "passage/{$version}/" . $votd['book'] . "/"
            . $votd['chapter'] . "/" . $votd['verse'] . "/";

    $status = 200;
    $result = array_merge(
                          array(
                                'status'=>$status,
                                'reference'=>$ref,
                                'link'=>$link
                              ),
                          $votd
                        );

    print_r(json_encode($result));

  } // end votd

  function passage($version='web', $book='Genesis', $chapter=1, $verse='')
  {
    global $db;

    $start_verse = 0;

    $version_symbol = Bible::get_active_version();
    $good_book = new Bible($db, $version_symbol, $book, $chapter);

    $status = 200;
    $staus_msg = "Ok";

    if(empty($good_book))
    {
      $status = 204;
      $status_msg = "No Content";

      print_r(json_encode(array("status"=>$status, "status_msg"=>$status_msg)));
    }
    else
    {
      if(isset($verse) && !empty($verse))
        $start_verse = $verse;

      if($start_verse > 0)
        print_r(json_encode($good_book->verses[$start_verse - 1]));
      else
        print_r(json_encode($good_book->verses));
    }

  } // end passage

  /**
   *
   */
  function user($method='show', $data=array())
  {
    # Change the method to lower case letters.
    $method = strtolower($method);

    # Figure out which method is being called.
    switch ($method)
    {
      case 'create':
        # Create a user, first paramter of $data must be authentication

        break;

      case 'show':
        # Retrieve/Read user data
        break;

      case 'update':
        # Update user data
        break;

      case 'destroy':
        # Destroy/Destroy user data * requires authentication *
        break;

      case 'subscribe':
        # Create a subscriber
        $response = array(
                          'status'=>405, // 405 Method Not Allowed
                          'msg'=>'Request method is not supported for the ' .
                          'requested resource. Must use POST.'
                        );

        if(isset($_POST['email']) && !empty($_POST['email']))
        {
          $response['status'] = User::subscribe_to_newsletter($_POST['email']);

          if(!is_numeric($response['status']))
          {
            if($response['status'] == true)
            {
              $response['status'] = 200;
              $response['msg'] = "success";
            }
          }
          else
          {
            $response['status'] = 200;
            $response['msg'] = "success";
          }
        }

        # Return response
        print_r(json_encode($response));
        break;

      default:
        # code...
        break;
    }
  }

}

?>
