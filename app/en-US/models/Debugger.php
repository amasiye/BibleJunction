<?php

/**
 * A useful class for debugging code.
 */
class Debugger
{
  private $log_msgs = array();
  private $error_msgs = array();

  /**
   * Updates the message log.
   * @param {string} $msg The message to be logged.
   */
  public function log($msg)
  {
    array_push($this->log_msgs, $msg);
  }

  /**
   * Updates the error message log.
   * @param {string} $msg The message to be logged.
   * @return {bool} True for a successful write, false otherwise.
   */
  public function error($msg)
  {
    array_push($this->error_msgs, $msg);
  }

  /**
   * Writes the contents of the log and error arrays to a file on disc.
   * @param {string} [$filename] *OPTIONAL* The name (or) of the file to write to. Will
   *                    create a file if none exists and it is possible to do
   *                    so.
   * @return {bool} True on successful write, false otherwise.
   */
  public function write_to_file($filename = '')
  {
    if(isset($filename) && !empty($filename))
      $file = fopen($filename, "a+");
    else
      $file = fopen(DEBUGPATH, "a+");

    $r = json_encode(array('logs'=>$log_msgs, 'errors'=>$error_msgs));

    if(fwrite($file, $r))
      return true;

    return false;
  }

  /**
   * Public accessor method. Provides an encapsulated view of the Debugger
   * class.
   * @param $type string The type of error.
   * @param $code int The numerical code of the error.
   * @return bool The string message corresponding to the type of error passed
   *         the arguments through.
   */
  public function get_error_msg($type, $code)
  {
    $msg = "";

    switch ($type)
    {
      case E_TYPE_NEWSLETTER:
        $msg = get_subscription_error_msg($code);
        break;

      default:
        # code ...
        break;
    }

    return $msg;
  } // end

  function get_http_error_msg($code)
  {
    $msg = "";

    switch($code)
    {
      case '400':
        $msg = "Bad Request - The request could not be understood by the " .
                "server due to malformed syntax. The client SHOULD NOT " .
                "repeat the request without modifications.";
        break;

      default:
    }

    return $msg;
  }

  /**
   * Returns the subscription error detail message corresponding to the error
   * code that's passed as through the parameter list.
   * @param $code int The numerical code of the error.
   * @return $msg bool A message string containing error details.
   */
  function get_subscription_error_msg($code)
  {
    $msg = "";

    switch ($code)
    {
      case '102':
        $msg = "Error: ({$code}) The email addresses you provided appears to be " .
                "invalid. Please return to the newsletter signup page and " .
                "double-check that your email address is entered correctly, " .
                "then try again. If you\"ve verified that your email address " .
                "is correct but you continue to receive this error message, " .
                "please contact us for assistance.";
        break;

      case '103':
        $msg = "Error: ({$code}) There was a problem subscribing you. You " .
                "subscribed to the Verse of the Day Digest but did not " .
                "select a translation. Please return to the newsletter " .
                "signup page and select at least one translation. If you " .
                "continue to receive this error, please contact us for " .
                "assistance.";
        break;

      default:
        $msg = "Error: ({$code}) Oops! There was a problem subscribing you. " .
               "Please return to the newsletter signup page and make sure " .
               "that your email address is correct and that you have at " .
               "least one newsletter subscription selected, then try again. " .
               "If you continue to receive this error, please contact us for " .
               "assistance.";
        break;
    }

    return $msg;
  } // get_subscription_error_msg

}

?>
