<?php


$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday');
$staryear = 1900;
$max_months = 13;
$leapyear = 5;
$total_loops = 0;

if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {

    $d = (int)$_GET['day'];
    $m = (int)$_GET['month'];
    $y = (int)$_GET['year'];

    if ($d == 22 && $m % 2 == 0) {
        $message = 'Invalid range. Cannot pick 22 days on an even month.';
    }
    if ($d == 22 && $m == 13 && $y % 5 == 0) {
        $message = 'Invalid range. Cannot pick 22 days on last month of leap year.';
    }

    if ($d > 22 || $d < 1){
        $message = 'Invalid date.';
    }

    if(!isset($message)){


        $loop_index = 0;
        $loop_year = $staryear;
        while($loop_year<=$y){
            $loop_month = 1;

             while($loop_month<=13){
                $loop_days = 1;

                if($loop_month % 2 == 1){$max_days = 22;}else{$max_days = 21;}
                if($loop_month ==13 && $loop_year % 5 == 0){$max_days = 21;}

                while($loop_days<=$max_days){
                    $total_loops++;


                    //echo 'Day: '.$loop_days.',Month: '. $loop_month.', Year:'.$loop_year.', Max Days: '.$max_days.', Index: '.$loop_index.'<br>';
                    if($loop_year==$y && $loop_month==$m && $loop_days==$d){$message = $days[$loop_index]; break 3;}
                    if($total_loops % 7 == 0){$loop_index = 0;}else{$loop_index++;}
                    $loop_days++;
                }

                 $loop_month++;
            }

            $loop_year++;
        }






    }




} else {
   $message =  'Not all parameters were defined!';
}




if(isset($message)){echo $message;}