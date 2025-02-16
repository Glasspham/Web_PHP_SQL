<?php
include 'inc/header.php';
include 'inc/sidebar.php';
require('../carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Order Statistics <?php echo Carbon::now('Asia/Ho_Chi_Minh'); ?></h2>
    <div class="block">
      <div class="col-md-4" style="text-align: center;justify-items: center;">
        from date: <input type="text" class="form-control" id="datepicker_from">
      </div>
      <div class="col-md-4" style="text-align: center;justify-items: center;">
        to date: <input type="text" class="form-control" id="datepicker_to">
      </div>
      <div class="col-md-4" style="text-align: center;justify-items: center;">
        filter:
        <span id="text_date"></span>
        <select class="form-control">
          <option style="text-align: center;justify-items: center;" value="">---Select---</option>
          <option style="text-align: center;justify-items: center;" value="7date">---Select---</option>
          <option style="text-align: center;justify-items: center;" value="30date">30 date</option>
          <option style="text-align: center;justify-items: center;" value="90date">90 date</option>
          <option style="text-align: center;justify-items: center;" value="365date">365 date</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="myfirstchart" style="height:250px; padding-top: 60px;"></div>

      </div>
    </div>
  </div>
</div>
<?php include 'inc/footer.php'; ?>