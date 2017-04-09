<?php

/**
 * The User model is responsible for reading and updating all user information
 * from the database.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class User
{
  public $name;
  public $email;
  public $registered;
  public $prefs;  // An array of user preferences

  function __construct($login)
  {
    global $db;

    $this->name = name;
  }

  /**
   * Creates a new user.
   *
   * @param $login string The login/username of the new user.
   * @return $success bool True on successful creation, otherwise false.
   */
  public static function create($login)
  {
    global $db;
    $success = false;

    # Creation code goes here

    return $success;
  }

  /**
   * Creates a user of type subscriber.
   *
   * @param $email string The email of the new subscriber.
   * @return $success bool Returns TRUE on success or FALSE | number on failure.
   */
  public static function subscribe_to_newsletter($email)
  {
    global $db;
    $success = true;

    if(!User::user_exists($email))
    {
      # Prepare SQL statement
      if($stmt = $db->conn->prepare("INSERT INTO bibleapp_users (user_login, user_email, user_registered, user_group) VALUES (?, ?, ?, ?)"))
      {
        if($stmt->bind_param("ssss", $u_login, $u_email, $u_registered, $u_group))
        {
          # Set the email and role and execute
          $u_login = $email;
          $u_email = $email;

          date_default_timezone_set('America/Halifax');
          $u_registered = date("Y-m-d H:i:s");

          $u_group = "subscriber";
          if(!$stmt->execute())
            $success = false;
        }
        else
        {
          $success = $stmt->errno;
        }
      }
      else
      {
        $success = $stmt->errno;
      }
    }
    else
    {
      $success = false;
    }

    return $success;
  } // end subscribe_to_newsletter

  /**
   * Destroys a newsletter subscription.
   *
   * @param $email string The email of the subscription to destroy.
   * @return $success bool Returns TRUE on success or FALSE | number on failure.
   */
  public static function unsubscribe_from_newsletter($email)
  {
    global $db;

    # Check if the user exists

    # If the user exists, proceed with deletion

    # Prepare statements

    # Bind and execute

  }

  /**
   * Performs a check to see if a user is in the database.
   *
   * @param $email string The email of the user in question.
   * @param $login string *OPTIONAL* The login/username of the user in question.
   * @return $exists bool True if the user does exists, otherwise false.
   */
  public static function user_exists($email, $login='')
  {
    global $db;
    $exists = false;

    # Prepre SQL statement
    $sql = "SELECT user_email FROM bibleapp_users WHERE user_email='{$email}' OR user_login='{$login}'";

    # Submit SQL query and check if the num_rows > 0
    if($result = $db->query($sql))
    {
      # Set $exists accordingly to findings
      if($result->num_rows > 0)
        $exists = true;
    }

    return $exists;
  }
}

?>
