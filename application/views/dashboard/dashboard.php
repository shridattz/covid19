<div class="container-fluid p-5">

  <!-- Image and text -->
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="https://cdn.iconscout.com/icon/free/png-256/corona-virus-2332182-1939007.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Covid 19
    </a>
    <p class="user-name my-2 my-sm-0  ">Welcome <?php echo $user['first_name'] ?><a href="<?php echo site_url('logout') ?>">(Logout)</a></p>
  </nav>


  <!-- Header -->
  <div class="row">
    <div class="col-7">
      <h1 class="title">Dashboard</h1>
    </div>

    <div class="col-5">

    </div>
  </div>

  <!-- Content -->
  <div class="row">
    <div class="col-8">
      <div id="india" style="height: 900px;"></div>
      <script>
        var dataURL = "<?php echo site_url('dashboard/getIndiaData') ?>";
        var deletePrefURL = "<?php echo site_url('dashboard/removeCountryPreference') ?>";
      </script>
      <script type="text/javascript" src="<?php echo base_url('res/js/dashboard/dashboard.js') ?>"></script>
    </div>

    <div class="col-4">
      <form id="addCountry" class="form-inline" action="<?php echo site_url('dashboard/addCountryPreference'); ?>">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select Country</label>
        <select class="custom-select my-1 mr-sm-2" id="country" name="country">
          <option selected>Choose...</option>
          <?php
          foreach ($countries as $country) {
            if (isset($country['iso2']) && !is_null($country['iso2']) && !empty($country['iso2'])) {
          ?>
              <option value="<?php echo $country['name'] ?>"><?php echo $country['name'] ?></option>
          <?php
            }
          }
          ?>
        </select>

        <button type="submit" class="btn btn-primary mb-2">Add</button>
      </form>

      <br>

      <div class="country-preferences">
        <?php foreach($infoCards as $infoCard) {
          echo $infoCard;
        }?>
        
      </div>    


    </div>
  </div>