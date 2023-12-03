<?php 


    include './MAIN/Dbconfig.php';

    include './check_function.php';

    $cust_id = $_COOKIE['custidcookie'];

    if(isset($_POST['pay_final'])){


        $final_amount = $_POST['pay_final'];
        $all_scheme_id = $_POST['all_scheme'];


        $date = date("Y-m-d H:i:s");

        //find the scheme details
        $find_details = mysqli_query($conlink, "SELECT * FROM all_schemes WHERE allscheme_id = '$all_scheme_id'");
        foreach($find_details as $details){
            $scheme_id = $details['scheme_id'];
            $ema = $details['ema'];
            $joindate = $details['join_date'];
            $enddate = $details['end_date'];
            $scheme_total = $details['s_total'];
        }

        $joinmonth = date("m", strtotime($joindate));
        $joinyear = date("Y", strtotime($joindate));

        $final_enddate = new DateTime($enddate);

        //find last paid month and year
        $find_last_paid = mysqli_query($conlink, "SELECT * FROM all_transactions WHERE all_scheme_id = '$all_scheme_id' ORDER BY ema_id DESC LIMIT 1");
        if(mysqli_num_rows($find_last_paid) > 0){
            foreach($find_last_paid as $last_paid){
                $lastmonth = $last_paid['pay_month'];
                $lastyear  = $last_paid['pay_year'];
            }
        }
        else{
            $lastmonth = $joinmonth;
            $lastyear = $joinyear;
        }


        //find totalpaid 
        $find_total_paid = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$all_scheme_id'");
        foreach($find_total_paid as $total_paid){
            $total_amount_paid = $total_paid['SUM(transaction_amount)'];
        }

        $amounttopay = $scheme_total - $total_amount_paid; //find the remaining amount to pay

        //Find last paid month
        $last_pay_query = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$all_scheme_id' AND pay_month = '$lastmonth' AND pay_year = '$lastyear'");
       
        foreach($last_pay_query as $last_pay){
            $last_paid_amount = $last_pay['SUM(transaction_amount)'];
        }

        $remaining_amount_topay = intval($ema - $last_paid_amount);




        //check if entered amount is less than the total amount to pay
        if($final_amount <= $amounttopay){
           //echo "stage 1 <br>";

            //check if entered amount is less than monthly ema
            if($final_amount <= $ema){
                //echo "amount less than ema <br>";

                $remaining_amount_topay;
                if($remaining_amount_topay >= $final_amount){
                    //echo "amount is less than amount to pay";
                    $pay_remaining_amount = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                    VALUES('$all_scheme_id','$scheme_id','$cust_id','$lastmonth','$lastyear','$date','$final_amount','paid')");
                    if($pay_remaining_amount){
                        //echo "successfully paid";

                        echo json_encode(array('status' => '1'));
                    }
                    else{
                        //echo "some error occured";
                        echo json_encode(array('status' => '0'));
                    }
                }
                else{
                    //echo "amount is greater than amount to pay";
                    $remaining_amount_topay.'<br>';
                    $amount_topay_nextmonth = $final_amount - $remaining_amount_topay;
                    $amount_topay_nextmonth.'<br>';
                    $next_month_find = date("d-".$lastmonth."-".$lastyear."");
                    $next_month_var = new DateTime($next_month_find);
                    $next_month = $next_month_var->modify('+1 month');
                    $next_month_number = $next_month->format("m");
                    $next_year_number = $next_month->format("Y");

                    
                    $pay_remaining_amount = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                    VALUES('$all_scheme_id','$scheme_id','$cust_id','$lastmonth','$lastyear','$date','$remaining_amount_topay','paid')");

                    if($pay_remaining_amount){
                        //echo "successfully paid <br>";

                        $pay_next_month_amount = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                        VALUES('$all_scheme_id','$scheme_id','$cust_id','$next_month_number','$next_year_number','$date','$amount_topay_nextmonth','paid')");

                        if($pay_next_month_amount){
                            //echo "Paid all Successfully";
                            echo json_encode(array('status' => '1'));
                        }
                        else{
                            //echo "SOme ERror occured";
                            echo json_encode(array('status' => '0'));
                        }

                    }
                    else{
                        //echo "some error occured";
                    }
                    
                }


                check_complete_scheme($all_scheme_id);
            }
            else{
                    //echo "amount greater than ema <br>";
                    ///check if there is any partial payment in the last paid month
                    if( intval($last_paid_amount) > 0){
                        $balancetopay = $ema - $last_paid_amount;
                        $newfinalbalance = $final_amount - $balancetopay;
                        $amount_for_ema = $newfinalbalance - fmod($newfinalbalance, $ema);
                        $final_remaining_balance = fmod($newfinalbalance, $ema);
                        $no_of_times = $amount_for_ema/$ema;
                        $paid_date =  date("d-".$lastmonth."-Y");
                        $newlastmonth = new DateTime($paid_date);
                        //print_r($newlastmonth);
                        $pay_start_date = $newlastmonth->modify(' +1 month');
                        //print_r($pay_start_date);
                        //$newpaid_date =  date("d-".$newlastmonth."-Y");
                        //$pay_start_date =  new DateTime($newpaid_date);
                        $new_enddate = new DateTime($paid_date);
                        $pay_end_date = $new_enddate->modify('+ '.$no_of_times.'month');

                        //print_r($pay_end_date);

                        mysqli_autocommit($conlink ,FALSE);


                        //pay the balance amount
                        if($balancetopay > 0){

                            
                            $pay_balance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                VALUES('$all_scheme_id','$scheme_id','1','$lastmonth','$lastyear','$date','$balancetopay','paid')");

                        }
                        else{

                            $pay_balance = mysqli_query($conlink, "SELECT scheme_id FROM all_transactions WHERE all_scheme_id = '$all_scheme_id'");

                        }
                       
                        //pay in terms, the pending amount
                        if($pay_balance){

                            for($var = $pay_start_date; $var <= $pay_end_date; $var->modify('+1 month')){

                                $paymonth = $var->format("m");
                                $payyear  = $var->format("Y");
                            
                                $pay_balance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                    VALUES('$all_scheme_id','$scheme_id','1','$paymonth','$payyear','$date','$ema','paid')");
                    
                                if($pay_balance){
                                    mysqli_commit($conlink);
                                }
                                else{
                                    mysqli_rollback($conlink);
                                }
                            }

                        }
                        
                        $remain_month = $var;

                        //pay the remaining amount
                        if($remain_month > $final_enddate){

                            $pay_remainbalance = mysqli_query($conlink, "SELECT scheme_id FROM all_transactions WHERE all_scheme_id = '$all_scheme_id'");

                        }
                        else{
                            
                            $remain_month_number = $var->format("m");
                            $remain_month_year = $var->format("Y");

                            //pay the balance amount
                            $pay_remainbalance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                VALUES('$all_scheme_id','$scheme_id','1','$remain_month_number','$remain_month_year','$date','$final_remaining_balance','paid')");
                        }

                        /*
                            $remain_month_number = $var->format("m");
                            $remain_month_year = $var->format("Y");

                            //pay the balance amount
                            $pay_remainbalance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                VALUES('$all_scheme_id','$scheme_id','1','$remain_month_number','$remain_month_year','$date','$final_remaining_balance','paid')");

                        */

                            if($pay_balance && $pay_remainbalance){
                                mysqli_commit($conlink);
                                echo json_encode(array('status' => '1'));
                            }
                            else{
                                mysqli_rollback($conlink);
                                echo json_encode(array('status' => '0'));
                            }
                        

                        check_complete_scheme($all_scheme_id);
                        
    

                    }
                    else{
                        //if not any partial payment in the last month
                        $balancetopay = 0;

                        $newfinalbalance = $final_amount - $balancetopay;
                        $amount_for_ema = $newfinalbalance - fmod($newfinalbalance, $ema);
                        $final_remaining_balance = fmod($newfinalbalance, $ema);
                        $no_of_times = $amount_for_ema/$ema;
                        $paid_date =  date("d-".$lastmonth."-Y");
                        $newlastmonth = new DateTime($paid_date);
                        $pay_start_date = $newlastmonth->modify(' +0 month');
                        //print_r($pay_start_date);
                        //$newpaid_date =  date("d-".$newlastmonth."-Y");
                        //$pay_start_date =  new DateTime($newpaid_date);
                        $new_enddate = new DateTime($paid_date);
                        $pay_end_date = $new_enddate->modify('+ '.$no_of_times.'month');

                        //print_r($pay_end_date);


                        mysqli_autocommit($conlink ,FALSE);
                        
                        //pay the balance amount
                        if($balancetopay > 0){

                            
                            $pay_balance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                VALUES('$all_scheme_id','$scheme_id','1','$lastmonth','$lastyear','$date','$balancetopay','paid')");

                        }
                        else{

                            $pay_balance = mysqli_query($conlink, "SELECT scheme_id FROM all_transactions WHERE all_scheme_id = '$all_scheme_id'");

                        }

                        
                       
                        //pay in terms, the pending amount
                        if($pay_balance){

                            for($var = $pay_start_date; $var < $pay_end_date; $var->modify('+1 month')){

                                $paymonth = $var->format("m");
                                $payyear  = $var->format("Y");
                            
                                $pay_balance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                    VALUES('$all_scheme_id','$scheme_id','1','$paymonth','$payyear','$date','$ema','paid')");
                                
                                if($pay_balance){
                                    mysqli_commit($conlink);
                                }
                                else{
                                    mysqli_rollback($conlink);
                                }
                    
                            }

                        }
                        
                        $remain_month = $var;

                        
                            $remain_month_number = $var->format("m");
                            $remain_month_year = $var->format("Y");

                            //pay the balance amount
                            $pay_remainbalance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                VALUES('$all_scheme_id','$scheme_id','1','$remain_month_number','$remain_month_year','$date','$final_remaining_balance','paid')");



                            if($pay_balance && $pay_remainbalance){
                                mysqli_commit($conlink);
                                echo json_encode(array('status' => '1'));
                            }
                            else{
                                mysqli_rollback($conlink);
                                echo json_encode(array('status' => '0'));
                            }
                       


                       /*
                        //pay the remaining amount
                        if($remain_month > $final_enddate){

                            $pay_remainbalance = mysqli_query($conlink, "SELECT scheme_id FROM all_transactions WHERE all_scheme_id = '$all_scheme_id'");

                        }
                        else{
                            
                            $remain_month_number = $var->format("m");
                            $remain_month_year = $var->format("Y");

                            //pay the balance amount
                            $pay_remainbalance = mysqli_query($conlink, "INSERT INTO all_transactions (all_scheme_id,scheme_id,cust_id,pay_month,pay_year,transaction_time,transaction_amount,transaction_status)
                                VALUES('$all_scheme_id','$scheme_id','1','$remain_month_number','$remain_month_year','$date','$final_remaining_balance','paid')");
                        }

                        */


                      check_complete_scheme($all_scheme_id);

                        
                    }    
                    
                    check_complete_scheme($all_scheme_id);
                }
            
        }
        else{
            echo json_encode(array('status' => '2'));
        }



        
       

    }




















































?>