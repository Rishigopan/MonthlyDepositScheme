<?php



    


    function check_complete_scheme($all_scheme_id){

        include './MAIN/Dbconfig.php';

        $find_scheme_amount = mysqli_query($conlink, "SELECT s_total FROM all_schemes WHERE allscheme_id = '$all_scheme_id'");
        foreach($find_scheme_amount as $find_scheme_amounts){
           
            $scheme_total_amount = $find_scheme_amounts['s_total'];
        }


        $find_paid_amount = mysqli_query($conlink, "SELECT SUM(transaction_amount) FROM all_transactions WHERE all_scheme_id = '$all_scheme_id'");
        foreach($find_paid_amount as $total_paid_amount){
            $total_amount_paid_till = $total_paid_amount['SUM(transaction_amount)'];
        }


        if($total_amount_paid_till == $scheme_total_amount){

            mysqli_query($conlink, "UPDATE all_schemes SET scheme_status = '1' WHERE allscheme_id = '$all_scheme_id'");
            
        }

    }















?>