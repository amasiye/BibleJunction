<?php
/**
 * The HTML class contains some useful methods for standardized markup.
 *
 * @since 0.0.1
 * @version 0.0.1
 *
 * @package bibleapp
 */
class HTML
{

  /**
   * Prints header section for a page element.
   * @param $txt String The string of text to appear inside the header section.
   */
  public static function print_page_header($txt)
  {
    $display_block = "<header><h3>{$txt}</h3></header>";

    echo $display_block;
  }

  /**
   * Prints the header for the article
   *
   * @param $txt String The string of text to appear inside the header section.
   */
  public static function print_article_header($txt)
  {
    $display_block = "<header class='ui-article-heading'><h3>{$txt}</h3></header>";

    echo $display_block;
  }

  /**
   * Prints the header for the panel
   *
   * @param $txt String The string of text to appear inside the header section.
   */
  public static function print_panel_header($txt)
  {
    $display_block = "<header class='ui-panel-heading'>{$txt}</header>";

    echo $display_block;
  }

  /**
   * Prints the ribbon for the verse of the day panel.
   *
   * @param $txt String The string of text to appear inside the header section.
   */
  public static function print_votd_ribbon($txt)
  {
    $display_block = "<span class='ui-votd-heading-ribbon-left'></span><span class='ui-votd-heading'>{$txt}</span><span class='ui-votd-heading-ribbon-right'></span><span class='ui-votd-heading-ribbon-right-2 '></span>";

    echo $display_block;
  }
}
?>
