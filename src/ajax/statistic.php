<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/database.php");
    include_once ($filepath."/../helpers/format.php");
    require('../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    $db = new Database();
    if(isset($_GET['times'])) {
        $times = $_POST['times'];
    } else {
        $times = '';
        $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    }
    // if($times == '7date') {
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
    // } elseif($times == '30date') {
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
    // } elseif($times == '90date') {
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
    // } elseif($times == '365date') {
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    // }
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    // if(isset($_POST['from_date']) && isset($_POST['from_to'])) {
    //     $from = $_POST['from_date'];
    //     $to = $_POST['from_to'];
    //     $query = "SELECT * FROM tbl_statistic WHERE `date` BETWEEN '$from' AND '$to' ORDER BY `date` ASC";
    // } else
    $query = "SELECT * FROM tbl_statistic WHERE `date` BETWEEN '$subdays' AND '$now' ORDER BY `date` ASC";
    $result = $db->select($query);
    foreach($result as $key => $row) {
        $chart_data[] = array(
            'date' => $row['date'],
            '_order' => $row['_order'],
            'revenue' => $row['revenue'],
            'quantity' => $row['quantity'],
        );
    }
    echo $data = json_encode($chart_data);
?>