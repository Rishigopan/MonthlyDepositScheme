<?php 
        
    include './MAIN/Dbconfig.php';


    if(isset($_POST['scheme_id'])){
 
        $schemeid = $_POST['scheme_id'];
        $custid = $_POST['cust_id'];
        $nominee = $_POST['nominee'];
        $relation = $_POST['relation'];

        $join_date = date("Y-m-d");
       
        

        $check_query = mysqli_query($conlink, "SELECT allscheme_id FROM all_schemes WHERE cust_id = '$custid' AND scheme_id = '$schemeid'");
        if(mysqli_num_rows($check_query) > 0){
            echo json_encode(array('join_scheme' => '0'));
        }
        else{


            $find_duration_query = mysqli_query($conlink, "SELECT scheme_duration,scheme_total FROM scheme_master WHERE scheme_id = '$schemeid'");
            foreach($find_duration_query as $find_duration){
                $duration = $find_duration['scheme_duration'] - 1;  
                $scheme_total = $find_duration['scheme_total'];
                $ema =  round( $find_duration['scheme_total'] / $find_duration['scheme_duration'] );
            }
           
            $end_date = date("Y-m-d", strtotime("+$duration month", strtotime($join_date)));


            $join_query =  mysqli_query($conlink, "INSERT INTO all_schemes (cust_id,scheme_id,nominee,relationship,join_date,end_date,ema,s_total,scheme_status) 
            VALUES ('$custid','$schemeid','$nominee','$relation','$join_date','$end_date','$ema','$scheme_total','0')");

            if($join_query){
                echo json_encode(array('join_scheme' => '1'));
            }
            else{
                echo json_encode(array('join_scheme' => '2'));
            }
        }
        


    }









    

?>