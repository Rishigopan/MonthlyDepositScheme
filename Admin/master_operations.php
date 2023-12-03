<?php 
        
    include '../MAIN/Dbconfig.php';


    if(isset($_POST['scheme_name'])){
 
        $schemename = $_POST['scheme_name'];
        $schemeamount = $_POST['scheme_amount'];
        $schemeduration = $_POST['scheme_duration'];
        $schemediscount = $_POST['scheme_discount'];
        $schemedescription = $_POST['scheme_description'];

      
        

        $check_query = mysqli_query($conlink, "SELECT * FROM scheme_master WHERE scheme_name = '$schemename' ");
        if(mysqli_num_rows($check_query) > 0){
            echo json_encode(array('addscheme' => '0'));
        }
        else{

            $find_max = mysqli_query($conlink, "SELECT MAX(scheme_id) FROM scheme_master");
            foreach($find_max as $max_id){
                $schemeid = $max_id['MAX(scheme_id)'] + 1;
            }
           
            $join_query =  mysqli_query($conlink, "INSERT INTO scheme_master (scheme_id,scheme_name,scheme_duration,scheme_total,scheme_discount,scheme_description) 
            VALUES ('$schemeid','$schemename','$schemeduration','$schemeamount','$schemediscount','$schemedescription')");

            if($join_query){
                echo json_encode(array('addscheme' => '1'));
            }
            else{
                echo json_encode(array('addscheme' => '2'));
            }
        }
        


    }









    

?>