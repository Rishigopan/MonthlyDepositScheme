<?php     


    

    include './MAIN/Dbconfig.php';

    if(isset($_POST['phone_number'])){

        $phone = $_POST['phone_number'];
        $password = $_POST['password'];
        // echo $username echo $password;
      
        
        if(!empty($_POST['phone_number']) && !empty($_POST['password'])){

            $exist_query = mysqli_query($conlink, "SELECT phone_number FROM user_details WHERE phone_number = '$phone'");
            if(mysqli_num_rows($exist_query) > 0){
                echo json_encode(array('success' => 0 , 'reg_id' => ''));
            }
            else{
    
                $fetch_id = mysqli_query($conlink, "SELECT MAX(user_id) FROM user_details");
                foreach($fetch_id as $ids){
                    $id = $ids['MAX(user_id)'];
                    $user_id = $id +1;
                    //echo $client_id;
                }
    
                if($fetch_id){

                    mysqli_autocommit($conlink,FALSE);

                    $signup_query = mysqli_query($conlink, "INSERT INTO user_details (user_id,phone_number,password,user_type) VALUES ('$user_id','$phone','$password','customer')");
                   
                    if($signup_query){
                        mysqli_commit($conlink);
                        if(mysqli_commit($conlink)){
                            echo json_encode(array('success' => 1 , 'reg_id' => $user_id));
                        }
                    }
                    else{
                        mysqli_rollback($conlink);
                        echo json_encode(array('success' => 2 , 'reg_id' => ''));
                    }
                   
                }
                else{
                    echo "max failed";
                }
            }
        }
        else{
            echo "Fields are empty";
        }
    }


    if(isset($_POST['cust_id'])){
 
        $user_type = 'customer';
        $custid = $_POST['cust_id'];
        $firstname = $_POST['first_name'];
        $lastname = $_POST['last_name'];
        $emailid = $_POST['emailid'];
        $gender = $_POST['gender'];
        $address = $_POST['address_cust'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];



            $updatecust_query =  mysqli_query($conlink, "UPDATE user_details SET first_name = '$firstname', last_name = '$lastname', email_id = '$emailid', gender = '$gender', cust_address = '$address', cust_state = '$state', city = '$city', pincode = '$pincode' WHERE user_id = '$custid' ");

            if($updatecust_query){
                echo json_encode(array('updatecust' => '1'));
                setcookie('custidcookie',$custid,time()+(86400*2), "/");
                setcookie('custtypecookie',$user_type,time()+(86400*2), "/");
            }
            else{
                echo json_encode(array('updatecust' => '2'));
            }

    }





?>