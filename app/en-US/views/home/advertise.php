<?php
require_once "includes/head.php";
$countries = App::get_country_names();
?>

<div class="ui-hero">
  <div class="jumbotron">
    <h1 class="align-center text-right">"...and I will send you out to fish for people."<br>
      <span class="small">Matt 4:19</span></h1>
    <p class="text-right">Let us help you cast a wider net!</p>
  </div>
</div>

<div data-role="page" id="pageone">

  <article>
    <?= HTML::print_page_header("Advertise with us"); ?>
    <p>Fill out the form below to receive more information:</p>

    <form role="form" action="" method="post">

      <!-- Title -->
      <div class="form-group col-md-2">
        <label for="title">Title:</label>
        <select class="form-control" id="title" name="title">
          <option></option>
          <option>Ms.</option>
          <option>Miss</option>
          <option>Mrs.</option>
          <option>Mr.</option>
          <option>Dr.</option>
          <option>Prof.</option>
          <option>Rev.</option>
          <option>Pastor.</option>
        </select>
      </div>

      <!-- First Name -->
      <div class="form-group col-md-5">
        <label for="first-name">First Name:</label>
        <input type="text" class="form-control" name="first-name" id="first-name" required>
      </div>

      <!-- Last Name -->
      <div class="form-group col-md-5">
        <label for="last-name">Last Name:</label>
        <input type="text" class="form-control" name="last-name" id="last-name" required>
      </div>

      <!-- Phone Number -->
      <div class="form-group col-md-4">
        <label for="phone-number">Phone Number:</label>
        <input type="text" class="form-control" name="phone-number" id="phone-number" required>
      </div>

      <!-- Organization Name -->
      <div class="form-group col-md-4">
        <label for="organization">Organization Name:</label>
        <input type="text" class="form-control" name="organization" id="organization" required>
      </div>

      <!-- Email Address -->
      <div class="form-group col-md-4">
        <label for="email">Email Address:</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>

      <!-- Job Title -->
      <div class="form-group col-md-4">
        <label for="job">Job Title:</label>
        <input type="text" class="form-control" name="job" id="job" required>
      </div>

      <!-- Organization Website URL -->
      <div class="form-group col-md-5">
        <label for="organization-url">Organization Website URL:</label>
        <input type="text" class="form-control" name="organization-url" id="organization-url">
      </div>

      <!-- Country -->
      <div class="form-group col-md-3">
        <label for="email">Country:</label>
        <select class="form-control" name="country" id="country" required>
          <option></option>
        <?php foreach ($countries as $key): ?>
          <option><?= $key; ?></option>
        <?php endforeach; ?>
        </select>
      </div>

      <!-- Address -->
      <div class="form-group col-md-6">
        <label for="address">Address:</label>
        <input type="text" class="form-control" name="address" id="address" required>
      </div>

      <!-- City -->
      <div class="form-group col-md-3">
        <label for="city">City:</label>
        <input type="text" class="form-control" name="city" id="city" required>
      </div>

      <!-- State -->
      <div class="form-group col-md-1">
        <label for="state">State:</label>
        <input type="text" class="form-control" name="state" id="state" pattern="[A-Za-z]{2|3}" title="Two or three letter state or province" required>
      </div>

      <!-- ZIP/Postal Code -->
      <div class="form-group col-md-2">
        <label for="postal">ZIP/Postal:</label>
        <input type="text" class="form-control" name="postal" id="postal" pattern="[A-Za-z0-9]{3}[-][A-Za-z0-9]{3}">
      </div>

      <div class="form-group col-md-3">
        <label for="budget">Ad Budget (Month):</label>
        <select class="form-control" name="budget" id="budget">
          <option>&dollar;100 - &dollar;300</option>
          <option>&dollar;301 - &dollar;500</option>
          <option>&dollar;501 - &dollar;1,000</option>
          <option>&dollar;1,001 - &dollar;5,000</option>
          <option>Over &dollar;5000</option>
        </select>
      </div>

      <!-- Tell Us How We can help -->
      <div class="form-group col-md-12">
        <label for="explanation">Let us know how we can help you:</label>
        <textarea class="form-control" name="explanation" id="explanation"></textarea>
      </div>

      <!-- Seperater -->
      <div class="form-group col-md-12"></div>

      <button class="btn pull-right" name="submit">Submit Your Information</button>

    </form>

    <div class="clearfix"></div>
  </article>

</div>
<?php require_once "includes/foot.php"; ?>
