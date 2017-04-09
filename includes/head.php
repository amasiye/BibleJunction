<?php require_once "includes/head-shared.php"; ?>
<body>
<header>

  <div data-role="logo" class='header-left'>
    <a href="<?= BASEPATH ?>"><h1><?= SITE_NAME; ?><h1></a>
  </div>

  <div class="header-right">

    <div class="searchbar-wrapper">

      <form id="search-form" action="search/" method="get" autocomplete="off">
        <div class="searchbar-container searchbar-search">
          <input type="search" name="searchbar-search" id="searchbar-search" class="searchbar-input searchbar-search" placeholder="Enter keyword, passage or topic">
          <ul class="dropdown-autocomplete hidden">
          </ul>
        </div>

        <div class="searchbar-container searchbar-version">
          <select>
            <option value="web">&mdash;English (EN)&mdash;</option>
            <option value="asv">American Standard Version (ASV)</option>
            <option value="niv">New International Version (NIV)</option>
            <option selected value="web">World English Bible (WEB)</option>
          </select>
        </div>

        <div class="searchbar-container searchbar-btn">
          <button id="btn-search" class="btn btn-default">Search</button>
        </div>
      </form>

    </div>

  </div>
</header>
