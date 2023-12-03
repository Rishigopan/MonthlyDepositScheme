<?php

function get_details($join_date,$end_date,$allschemeid,$ema){

include './MAIN/Dbconfig.php';

$new_join =  new DateTime( $join_date );
$new_end =  new DateTime( $end_date );



    for($var = $new_join; $var <= $new_end; $var->modify('+1 month')){


        $paymonth = $var->format("m");
        $payyear  = $var->format("Y");
        $monthname = $var->format("M");
        
        $find_payment = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$allschemeid' AND pay_month = '$paymonth' AND pay_year = '$payyear'");

        while($find_pay = mysqli_fetch_array($find_payment)){

            $paid_amount = $find_pay['SUM(transaction_amount)']; 

            if($paid_amount == null){
                $status = 'Not Paid';
            }
            elseif($paid_amount < $ema){
                $status =  "not fully paid";
            }
            else{
                $status = "paid";
            }

            $balance = $ema -$paid_amount;

            $final_array = array('month' => $monthname, 'sum' => $paid_amount, 'status' => $status,'balance' => $balance);
            
        }
        
    }
return $final_array;
}

?>