<?php


    include './MAIN/Dbconfig.php';

    $newbalance = 0;

    if(isset($_POST['scheme_id'])){

        

        $allschemeid = $_POST['scheme_id'];


        $find_details = mysqli_query($conlink, "SELECT * FROM all_schemes WHERE allscheme_id = '$allschemeid'");
        foreach($find_details as $find_all){
            $join_date = $find_all['join_date'];
            $plan_end_date = $find_all['end_date'];
            $ema = $find_all['ema'];
        }


        $today_date = date("Y-m-d");
        $today_month = date("m");
        $today_year = date("Y");
        $new_join =  new DateTime($join_date);


        if($today_date > $plan_end_date){
            $new_end =  new DateTime($plan_end_date);
        }
        else{
            $new_end =  new DateTime($today_date);
        }



        $final_array = array();

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

                $new_array = array('month' => $monthname, 'sum' => $paid_amount, 'status' => $status,'balance' => $balance);

            }

            array_push($final_array, $new_array);

        }

        foreach($final_array as $finals=>$value){
            $newbalance = $newbalance + $value['balance'];
        }


        $find_paid = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$allschemeid' AND pay_month = '$today_month' AND pay_year = '$today_year'" );
        
            
            foreach($find_paid as $find_paids){
                $sumpaid = intval($find_paids['SUM(transaction_amount)']);
            }

            if($sumpaid > 0){
                if($sumpaid == $ema){
                    $pending = 0;
                    $newema = 0;
                    $total = 0;
                    echo json_encode(array('total' => $total, 'newema' => $newema, 'pending' => $pending, 'ema' => $ema));
                }
                else{
                    $pending = $ema - $sumpaid;
                    $newema = 0;
                    $total = $ema - $sumpaid;
                    echo json_encode(array('total' => $total, 'newema' => $newema, 'pending' => $pending, 'ema' => $ema));
                }
            }
            else{
                if(intval($newbalance) > 0){
                    $pending = $newbalance - $ema;
                    $newema = $ema;
                    $total = $newbalance;
                    echo json_encode(array('total' => $total, 'newema' => $newema, 'pending' => $pending, 'ema' => $ema));
                }

            }
    }






?>