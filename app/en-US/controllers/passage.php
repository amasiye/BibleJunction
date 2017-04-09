<?php
/**
 * The Passage controller updates the passage view when an attempt to retrieve
 * scripture from the database is made.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class Passage extends Controller
{
  /**
   * @param {string} $name The user name to assign for this session
   */
  public function index($version = '', $book = '', $chapter = '', $verse = '')
  {
    global $db;

    if(user_is_logged_in())
    {
      $user = $this->model('User');
      $this->view('passage/index', ['user' => $user]);
    }
    else
    {
      if(!empty($version) && !empty($book))
      {
        # If a chapter is provided
        if(isset($chapter) && !empty($chapter))
        {
          # And one verse or more is/are provided
          if(!empty($verse))
            $bible = new Bible($db, $version, $book, $chapter, $verse);
          else
            $bible = new Bible($db, $version, $book, $chapter);
        }
        else
        {
          # Otherwise get chapter 1 by default.
          $bible = new Bible($db, $version, $book);
        }

        if($dash_pos = strpos($verse, "-"))
        {
          $start = substr($verse, 0, $dash_pos);
          $end = substr($verse, $dash_pos + 1);

          # Ensure that $end is never greater than $start
          if($start > $end)
            $end = $start;
        }
        else if(!empty($verse))
        {
          $start = $verse;
          $end = $verse;
        }
        else
        {
          $start = 1;
          $end = count($bible->verses);
        }

        $this->view(
                      'passage/index',
                      [
                        'bible' => $bible,
                        'chapter' => $chapter,
                        'verse' => $verse,
                        'start' => $start,
                        'end' => $end
                      ]
                    );

      }
      else
      {
        $this->view('passage/index');
      }
    }
  }
}

?>
