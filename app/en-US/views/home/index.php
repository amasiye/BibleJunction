<?php
require_once "includes/head.php";
$votd = $data['votd'];
// $votd_ref =
?>
<div data-role="page" id="pageone">

  <!-- Seperator -->
  <div class="separator-horizontal"></div>

  <!-- Seperator -->
  <div class="separator-horizontal"></div>

  <!-- Verse Of The Day -->
  <div class="ui-panel ui-panel-votd">
    <?= HTML::print_votd_ribbon("Verse of the Day"); ?>
    <div class="ui-panel-body">
      <p><?= ucfirst($votd['text']); ?></p>
      <p class="small">
        <a href="passage/<?= $votd['version_symbol']; ?>/<?= ucfirst($votd['book']); ?>/<?= $votd['chapter']; ?>/<?= $votd['verse']; ?>">
          <?= ucfirst($votd['book']); ?>&nbsp;<?= $votd['chapter']; ?>:<?= $votd['verse']; ?>&nbsp;<?= strtoupper($votd['version_symbol']); ?></a><br>
        <small><?= $votd['info']; ?></small></p>
    </div>
  </div>

  <!-- Seperator -->
  <div class="separator-horizontal"></div>

  <!-- Subscribe -->
  <div class="ui-panel">
    <div class="ui-panel-body" style="min-height: 196px;">
      <p class="small col-sm-12 col-md-12 col-lg-7" style="padding: 5px 10px;">Subscribe to have the Verse of the Day emailed to your inbox each morning.</p>
      <input type="email" name="email" id="email" class="col-sm-12 col-md-12 col-lg-3" pattern="[\w\d-._]+@[]+[.][\w]{2|3}[\w]{2}?" placeholder="Your email address">
      <div class="col-sm-12 col-md-12 col-lg-2">
        <button class="btn" style="width: 100%;" id="subscribe">Subscribe</button>
      </div>
      <p class="clearfix small col-sm-12 col-md-12" style="padding: 5px 10px;">By submitting your email address, you understand that you will receive email communications from <?= SITE_NAME; ?>, including commercial communications and messages from partners of <?= SITE_NAME; ?>. You may unsubscribe from <?= SITE_NAME; ?>&apos;s emails at any time. If you have any questions, please review our Privacy Policy or email us at <?= EMAIL_PRIVACY; ?>.</p>
    </div>
  </div>

  <!-- Seperator -->
  <div class="separator-horizontal"></div>

</div>
<?php require_once "includes/foot.php"; ?>
