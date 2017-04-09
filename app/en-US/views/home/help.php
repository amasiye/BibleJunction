<?php require_once "includes/head.php"; ?>
<div data-role="page" id="pageone">

  <div class="ui-panel">
    <?= HTML::print_panel_header("Help"); ?>
    <div class="ui-panel-body">
      <h3><a href="help/faq/">Frequently Asked Questions</a></h3>
      <p>Questions about the <?= SITE_NAME; ?>? Check this section to find
        answers and solutions to commonly-asked questions.</p>
      <p><a href="help/faq/">View the frequently asked questions</p>
      <hr>
      <h3><a href="help/tutorial/">Tutorial</a></h3>
      <p>Don't know where to begin? This tutorial will introduce you to the
        <?= SITE_NAME; ?>'s tools and resources, and show you how to use them effectively.</p>
      <p><a href="help/tutorial/">Go to the tutorial</a></p>
    </div>
  </div>
</div>
<?php require_once "includes/foot.php"; ?>
