<?php

    // Declare two dates
    $start_date = strtotime(date("2019-03-17"));
    $end_date = strtotime("2019-06-29");

    // Get the difference and divide into
    // total no. seconds 60/60/24 to get
    // number of days
    $datdife = ($end_date - $start_date)/60/60/24;
    $datdif = round($datdife);

    if($datdif == 0){
        echo "Due Date is Today";
    }elseif($datdif < 0){
        echo "Date is past.";
    }else{
        echo "Difference between two dates: " .$datdif." Day(s)<br/>";
    }

    $weeks = floor($datdif / 7);

    $dayRemainder = $datdif % 7;

    echo $datdif.' Days Converts to <br/>'.$weeks.' Weeks <br/>'.$dayRemainder." Days";

?>
