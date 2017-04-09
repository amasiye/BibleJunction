<?php

/**
 * This file contains some usefull free functions that wouldn't make
 * sense belonging to any class files.
 *
 * @package BibleApp
 */

function user_is_logged_in()
{
    if
    (
      isset($_SESSION[SITE_PREFIX . 'username']) &&
      !empty($_SESSION[SITE_PREFIX . 'username'])
    )
    return true;

  return false;
}

/**
 * Empties out an array.
 *
 * @param &$a The array to empty;
 * @return N/A
 * @pre An array of size > 0 is passed to the function.
 * @post All elements of the array have been removed.
 */
function array_empty(Array &$a)
{
  $size = count($a);

  for($x = 0; $x < $size; $x++)
  {
    array_pop($a);
  }
}

/**
 * Checks if a string of text begins with a number 
 */
function starts_with_number($txt)
{

  return false;
}

?>
