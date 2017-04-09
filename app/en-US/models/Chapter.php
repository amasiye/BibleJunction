<?php

/**
 * 
 */
class Chapter
{
  public $id;
  public $verses;

  private $verse_count = 0;

  function __construct($id)
  {
    $this->id = $id;
    $this->verses = array();
  }

  public function add_verse($verse)
  {
    $verse_count++;
    
    $v = new Verse($verse_count, $verse);

    array_push($this->verses, $v);
  }

  /**
   * 
   */
  class Verse
  {
  public $id;
  public $text;

  function __construct($id, $text)
  {
    $this->id = $id;
    $this->text = $text;
  }
}
}

?>