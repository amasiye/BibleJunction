<?php

/**
 * The model class for all bible data. The bible object selects and holds
 * passage specific information, bible version data as well as copyright
 * information.
 *
 * @since 0.0.1
 * @version 1.0.0
 * @author A. Masiye
 *
 * @package bibleapp
 */
class Bible
{
  public $name = 'Matthew';
  public $symbolic_name = "MAT";
  public $version_name = 'ASV';
  public $version_info;
  public $error = array();
  public $table = 'eng_asv_vpl';
  public $chapters;
  public $verses;
  public $start_verse;
  public $end_verse;
  public $total_verses_in_chapter = 1;

  private $book;
  private $db;

  /**
   * The Bible class constructor.
   * @param {DbContext} $db The DbContext object to use for database interactions.
   * @param {string} $version The version (translation) of the Bible to be constructed.
   * @param {string} $book The book of the Bible being referenced.
   * @param {string} $chapter [Optional] The chapter(s)s being looked-up.
   * @param {string} $verse [Optional] The verse(s) being looked-up.
   */
  function __construct(DbContext $db, $version, $book, $chapter = '1', $verse = '')
  {
    if(starts_with_number($book))
    {

    }

    $this->db = $db;
    $this->version_name = strtoupper($version);

    # Ge the table name for the bible version selected
    $this->table = $this->get_table_name($this->version_name, $this->version_info);

    # Handle underscores for requests via the api/passage/... end points
    $book = str_replace('_', ' ', $book);
    $this->name = $book;

    # Use book look up translation table to get symbolic name
    $this->symbolic_name = Bible::get_symbolic_name(ucfirst($this->name));
    $this->chapters = array();

    # Parse the chapter for a range of chapters or a single chapter
    if($dash_pos = strrpos($chapter, "-"))
    {
      $start = substr($chapter, 0, $dash_pos);
      $end = substr($chapter, $dash_pos + 1);

      $sql = "SELECT * FROM {$this->table} WHERE book='{$this->symbolic_name}' AND chapter BETWEEN {$start} AND {$end}";
    }
    # Since a range would not be numeric
    else if(is_numeric($chapter))
    {
      $sql = "SELECT * FROM {$this->table} WHERE book='{$this->symbolic_name}' AND chapter={$chapter}";
    }
    else
    {
      array_push($this->error, "Invalid chapter data.");
    }

    # Handle the verses
    $this->verses = array();
    $this->total_verses_in_chapter = $this->get_num_verses_for_chapter($chapter);
    $this->start_verse = $verse;
    $this->end_verse = 0;

    # If there is a dash in the verse (i.e verse is a range)
    if($dash_pos = strrpos($verse, "-"))
    {
      $this->start_verse = substr($verse, 0, $dash_pos);
      $this->end_verse = substr($verse, $dash_pos + 1);

      if($this->start_verse > $this->end_verse)
      {
        $this->start_verse = 1;
        $this->end_verse = $this->total_verses_in_chapter;
      }
    }

    if(isset($sql))
    {
      if($result = $db->query($sql))
      {
        while ($row = $result->fetch_assoc())
        {
          # If a verse is NOT specified
          if(!isset($verse) || empty($verse))
          {
            # Grab verses from the chapter, and fix appostrophe
            # since the default encoding is 'utf-8'
            $txt = str_replace("’", "'", $row['verseText']);

            # Add the verse to the verses array
            array_push($this->verses, $txt);
          }
          else
          {
            if(!$this->end_verse) # No end verse, therefore only start verse specified
            {
              if($row['startVerse'] == $this->start_verse)
              {
                $txt = str_replace("’", "'", $row['verseText']);
                array_push($this->verses, $txt);
              }
            }
            # Both start and end verse have been specified
            else
            {
              if($row['startVerse'] >= $this->start_verse && $row['startVerse'] <= $this->end_verse)
              {
                $txt = str_replace("’", "'", $row['verseText']);
                array_push($this->verses, $txt);
              }
            }
          }

        }

        array_push($this->chapters, $chapter);
      }
      else
      {
        array_push($this->error, $db->conn->error);
      }
    }

  } // end __construct

  /**
   * Returns the name of the table containing the bible data related
   * to the version symbol argument. Updates the $version_info attribute.
   *
   * @param $version_symbol String The symbolic name of the bible version to be looked
   *                        up.
   * @param $version_info String Reference to the class attribute $version_info (this)
   *                      is passed so that it is explicit about the side effect
   *                      of this function: it modifies the version info.
   * @return String The name of the table in the database containing the bible data
   *         related to the version specified by the $version_symbol parameter.
   */
  function get_table_name($version_symbol, &$version_info)
  {
    $table_name = "eng_asv_vpl";
    $db = $this->db;

    if(isset($version_symbol) && !empty($version_symbol))
    {
      $sql = "SELECT version_info FROM bibleapp_vesrions WHERE version_symbol='{$version_symbol}'";

      if($result = $db->query($sql))
      {

        if($row = $result->fetch_assoc())
        {
          $version_info = json_decode($row['version_info'], true);
          $table_name = $version_info['table'];
        }
        else
        {
          array_push($this->error, "Table appears to be empty.");
        }

      }
      else
      {
        array_push($this->error, "Failed to run query.");
      }

    }
    else
    {
      array_push($this->error, "Symbol not set.");
    }

    return $table_name;

  } // end get_table_name

  /**
   * Performs a bible search for passages, names and keywords relating to the
   * given query string.
   * @param {string} $query The search item.
   * @param {string} $version [Optional] The bible version.
   * @return {array} Returns an array of search results or false if an error occured.
   */
  public static function search($query, $version = 'WEB')
  {
    # Pattern for a scripture look up
    $patt = '/^[\d]?[\s]?[\w]+[\s][\d]+[:][\d]+$/';

    # Lookup passages if query is a valid scripture reference
    if(preg_match($patt, $query))
    {
      # Search
    }

    # Lookup names

    # Lookup keywords

    return false;
  } // end search()

  /**
   * Returns a list of all the available bible versions
   * from the database.
   *
   * @param $db DbContext A DbContext object for database connection.
   * @return $names An array of bible version names.
   */
  public static function get_bible_version_names($db)
  {
    $names;
    $conn = $db->conn;

    return $names;
  } // end get_bible_version_names

  /**
   * Returns a list of all the available bible versions
   * from the database.
   *
   * @param $db DbContext A DbContext object for database connection.
   * @return $symbols An array of bible version name symbols -
   * e.g NIV for New International Version.
   */
  public static function get_bible_version_symbols(DbContext $db)
  {
    $symbols;
    $conn = $db->conn;

    return $symbols;
  } // end get_bible_version_symbols

  /**
   * Returns the active bible version.
   * @param $fullname bool The full name of the active version will be returned if set to true.
   * @return String The active bible version.
   */
  public static function get_active_version($fullname = false)
  {
    $version_abbr = "WEB";
    $version_full = "World English Bible";

    # Retrieve the active version
    if(isset($_COOKIE['def_ver']) && !empty($_COOKIE['def_ver']))
    {
      $version_abbr = $_COOKIE['def_ver'];
      $version_full = Bible::get_version_full(strtoupper($version_abbr));
    }

    # Code for getting the active bible version goes here ...
    if($fullname)
      return $version_full;

    return $version_abbr;
  } // end get_active_version

  /**
   * Returns the full name of a bible version/translation.
   *
   * @param $version_symbol String The symbolic name of the bible version.
   * @return String The full name of the bible verion/translation.
   */
  public static function get_version_full($version_symbol)
  {
    global $db;

    $sql = "SELECT version_name FROM bibleapp_vesrions WHERE version_symbol='{$version_symbol}'";

    if($result = $db->query($sql))
    {
      if($row = $result->fetch_assoc())
        return $row['version_name'];
      else
        return mysqli_error($db->conn);
    }

    return mysqli_error($db->conn);
  } // end get_version_full

  /**
   * Returns the Verse of the day.
   */
  public static function get_votd($options = array())
  {
    $txt = "It is written: “‘As surely as I live,’ says the Lord, " .
            "‘every knee will bow before me; every tongue will " .
            "acknowledge God.’”";

    $ver = Bible::get_active_version(); # By default, no param == false

    # Get version option
    if(isset($options['version']) && !empty($options['version']))
      $ver = $options['version'];

    $version = Bible::get_active_version(true);
    $version_symbol = strtoupper($ver);

    # If no version was specified, use the active version
    if(!isset($version_symbol) || empty($version_symbol))
      $version_symbol = Bible::get_active_version();

    $book = "Romans";
    $chapter = "14";
    $verse = "11";
    $info = "Today's passage is from the " . $version . ".";

    global $locale;
    $votd_json_path = "app/{$locale}/content/votd.json";

    if($file = fopen($votd_json_path, "r"))
    {
      $votd_txt = "";

      while(!feof($file))
      {
        $votd_txt .= fgets($file);
      }

      fclose($file);

      $votd_monthly = json_decode($votd_txt, true)
                        or die("Failed to decode json string.");

      date_default_timezone_set('America/Halifax');

      if(isset($options['timezone']) && !empty($options['timezone']))
        date_default_timezone_set($options['timezone']);

      # Parse the votd info and get the date value
      $votd_info = explode("|", $votd_monthly[date('F')][ltrim(date('d'), 0)]);
      $book = $votd_info[0];
      $chapter = $votd_info[1];
      $verse = $votd_info[2];

      global $db;
      $good_book = new Bible($db, $version_symbol, $book, $chapter);

      $txt = $good_book->verses[$verse - 1];
    }
    else
    {
      echo "<br>Failed to open file: {$votd_json_path}.";
    }

    return array(
                  'text'=>$txt,
                  'version'=>$version,
                  'book'=>$book,
                  'chapter'=>$chapter,
                  'verse'=>$verse,
                  'version_symbol'=>$version_symbol,
                  'info'=>$info
                );
  } // end get_votd

  /**
   * Writes the symbolic book names from the database to a file on disc.
   *
   * @param $table String The name of the table to get the book names from.
   * @param $filename String The name/path of the output file.
   * @return bool Returns true if the names were successfully written to a file, otherwise false.
   */
  public static function fwrite_book_names($table="eng_web_vpl", $filename="web-books.txt")
  {

    $sql = "SELECT book FROM {$table}";

    $books = array();

    global $db, $locale;

    if($r = $db->query($sql))
    {
      while($row = $r->fetch_assoc())
      {
        array_push($books, $row['book']);
      }
    }

    $out = "";

    $unique_books = array_unique($books);
    foreach ($unique_books as $key)
    {
      $out .= $key . PHP_EOL;
    }

    $file = fopen("app/{$locale}/content/{$filename}", "w");
    fputs($file, $out);
    fclose($file);

    return true;
  } // end fwrite_book_names

  /**
   * Formats the book name to include a space between the book number
   * and book name for book names that begin with a number.
   *
   * @param $book string The name of the book from the Bible.
   * @pre An unformatted string representing the name of a book in the Bible
   *      is provided.
   * @post The string is formatted to include a space between any numbers
   *       preceeding the book's name.
   */
  public static function format_book_name($book)
  {
    # If the book starts with a number insert a space after number
    $sample_size = 1;
    $space_flag = false;
    $first_char = substr($book, 0, 1);
    $second_char = substr($book, 1, 1);
    $rest_of_book = substr($book, 1);

    # Check first character of book string and insert space after number accordingly
    if(is_numeric($first_char) && is_numeric($second_char) && strcmp($second_char, ' ') != 0)
      $book = $first_char . ' ' . $rest_of_book;

    return $book;
  } // end format_book_name()

  /**
   * Returns the symbolic name of a given book from the Bible.
   *
   * @param $book string The name of the book from the Bible.
   * @return $symbolic_name string The symbolic name of the given book from the Bible.
   */
  public static function get_symbolic_name($book)
  {
    global $locale;
    $lookup_table = "";
    $symbolic_name = "";

    // echo $book; exit;

    # Get lookup_table
    $file = fopen(FILE_LOOKUP_TABLE, "r");
    while (!feof($file))
    {
      $lookup_table .= fgets($file);
    }
    fclose($file);

    # Decode JSON string
    $lookup_table_decoded = json_decode($lookup_table, true);

    // echo Bible::format_book_name($book); exit;
    // var_dump($lookup_table_decoded); exit;

    # Set symbolic_name
    $symbolic_name = $lookup_table_decoded[strtolower(Bible::get_active_version())][Bible::format_book_name($book)];
    return $symbolic_name;
  } // end get_symbolic_name

  /**
   * Returns the number of verses that are found in a specific chapter.
   *
   * @param $version String The version/translation of the Bible.
   * @param $book String The name of the book from the Bible.
   * @param $chapter String The name of the chapter.
   * @return int The number of verses in the chapter.
   */
  function get_num_verses_for_chapter($chapter)
  {
    global $db;
    $num_verses = 1;

    $sql = "SELECT chapter, book FROM {$this->table} WHERE book='{$this->symbolic_name}' AND chapter={$chapter}";

    if($result = $db->query($sql))
    {
      $num_verses = $result->num_rows;
    }
    else
    {
      array_push($this->error, mysqli_error($db->conn));
    }

    return $num_verses;
  } // end get_num_verses_for_chapter

  /**
   * Returns the last recorded error message.
   *
   * @return String The last recorded error message.
   */
  function get_last_recorded_error()
  {
    return $this->error[count($this->error) - 1];
  } // end get_last_recorded_error

}

?>
