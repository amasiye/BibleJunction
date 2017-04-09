<?php
  require_once "includes/head.php";

  if(isset($data['bible']) && !empty($data['bible']))
  {
    $bible = $data['bible'];
    $chpt = $data['chapter'];
    $start_verse = $data['start'];
    $end_verse = $data['end'];
    $appendage = "";

    if(!empty($bible->start_verse))
    {
      # Add the starting verse to the title
      $appendage .= ":" . $bible->start_verse;

      # Add the ending verse to the title
      if(!empty($end_verse) && $end_verse > $bible->start_verse)
        $appendage .= "-" . $bible->end_verse;

      # Add a link to the full passage
      $appendage .= "&nbsp;<a href='passage/" . strtolower($bible->version_name)
                      . "/{$bible->name}/{$chpt}' title='View Full Chapter'><i class='fa fa-navicon'></i></a>";
    }

    if(empty($chpt))
    {
      $chpt = 1;
    }

    $page_title = $bible->name . " " . $chpt . $appendage;
  }
  else
  {
    $page_title = "Passage Lookup";
  }
?>
<div data-role="page" id="pageone">
  <div data-role="header"></div>

  <article>
    <?php
      echo HTML::print_page_header($page_title);

      # If we have bible verses display them
      if(!empty($bible->verses)):
    ?>
    <p>
      <?php

        # if the starting verse and ending verse are the same, then there is
        # only on verse to echo.
        if(!empty($bible->start_verse) && ($bible->start_verse <= $bible->end_verse || $bible->end_verse == 0))
        {
          # Initialize the verse count
          $verse_count = $bible->start_verse;

          if($bible->start_verse <= $bible->end_verse)
          {
              $num_verses = $bible->end_verse - $bible->start_verse;
              // echo "Start: " . $bible->start_verse . "<br>End: " . $bible->end_verse;
          }
          else
            $num_verses = 1;

          # Since bible verses is a non-associative array, indeces start at zero.
          for($x = 0; $x <= $num_verses; $x++)
          {
            echo "<p><sup>" . ($verse_count) . "</sup>&nbsp;" . $bible->verses[$x] . "</p>";
            $verse_count++;

            # We must break out of the loop if there is only one verse
            if($num_verses == 1 && (empty($bible->end_verse) || $bible->end_verse == 0))
              break;
          }
        }
        else
        {
          # Initialize the verse count
          $verse_count = 1;
          $num_verses = $bible->total_verses_in_chapter;

          # Since bible verses is a non-associative array, indeces start at zero.
          for($x = 0; $x < $num_verses; $x++)
          {
            echo "<p><sup>" . ($verse_count) . "</sup>&nbsp;" . $bible->verses[$x] . "</p>";
            $verse_count++;
          }
        }
      ?>
    </p>

    <?php else: ?>
    <p><strong>Error: </strong>Unfortunately we could not retrieve the requested bible passage(s).</p>

    <!-- #DEBUG -->
    <p><strong>Debug merry christmas: </strong><?= $bible->error[0]; ?></p>

    <?php endif; ?>

    <p id='version-info'>
      <strong><?= $bible->version_info['name'] . " (" .
        $bible->version_name  . ")"; ?></strong><br>
      <?= $bible->version_info['copyright']; ?>
    </p>
  </article>

  <aside>
  </aside>

  <div data-role="footer"></div>

</div>
<?php require_once "includes/foot.php"; ?>
