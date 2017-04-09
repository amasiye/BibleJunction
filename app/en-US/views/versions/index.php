<?php require_once "includes/head.php"; ?>
<div data-role="page" id="pageone">
  <div data-role="header"></div>
  <article>
    <?= HTML::print_page_header("Versions"); ?>
    <table>
      <?php foreach ($data['versions'] as $key => $value): ?>
        <tr>
          <td></td>
        </tr>
      <?php endforeach; ?>
    <table>
  </article>
  <aside>

  </aside>
</div>
<?php require_once "includes/foot.php"; ?>
