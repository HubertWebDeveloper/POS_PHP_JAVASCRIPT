<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#table_cust" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">View Tables</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#insert_cust" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Insert New Data</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>
    <a href="download/customer_download.php" style="text-decoration:none;color:grey">Download List</a>
    </button>
   </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="table_cust" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <?php include("popup/customer_table.php"); ?>
  </div>
  <div class="tab-pane fade" id="insert_cust" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
    <?php include("popup/customer_insert.php"); ?>
  </div>
</div>
      