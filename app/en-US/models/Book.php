<?php

/**
 * 
 */
class Book
{
  public $name;
  public $chapters = [];
  public $error;

  private $chapter_count = 0;

  function __construct(DbContext $db, $table, $name, $chapter='')
  {
    $this->error = array();

    $sql = "SELECT * FROM {$table} WHERE book='{$name}'";
  }

  public function add_chapter($id, )
  {

  }
}

?>