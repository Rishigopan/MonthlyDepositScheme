<?php     


include './MAIN/Dbconfig.php';

$user = 0;
$pass = 0;
    if(isset($_POST['phone_number'])){

        $phone = $_POST['phone_number'];
        $password = $_POST['password'];
       
        if (!empty($_POST['phone_number']) && !empty($_POST['password'])) {

            $search_user = mysqli_query($conlink, "SELECT phone_number FROM user_details WHERE phone_number = '$phone'");

            foreach($search_user as $user_rows){
                if($phone === $user_rows['phone_number']){
                    $user = 1;
                }
                else{
                    $user = 0;
                }
            }
            if($user === 1){

                $search_pass = mysqli_query($conlink, "SELECT password FROM user_details WHERE phone_number = '$phone'");

                foreach($search_pass as $pass_rows){

                    if($password === $pass_rows['password']){
                        $pass = 1;
                    }
                    else{
                    // $pass = 0;
                    }
                        
                }
                if(($user === 1) & ($pass === 1)){

                    $id_query = mysqli_query($conlink, "SELECT user_id,user_type from user_details WHERE phone_number = '$phone' AND password = '$password' ");
                    foreach($id_query as $id_row){
                        $user_id = $id_row['user_id'];
                        $user_type = $id_row['user_type'];
                        setcookie('custnamecookie',$phone,time()+(86400*2), "/");
                        setcookie('custidcookie',$user_id,time()+(86400*2), "/");
                        setcookie('custtypecookie',$user_type,time()+(86400*2), "/");
                    }

                    if($user_type == 'admin' ){
                        echo json_encode(array('success' => 1));
                    }
                    elseif($user_type == 'customer' ){
                        echo json_encode(array('success' => 2));
                    }

                }
                else{

                   // echo json_encode(array('success' => 0));
                    echo "Password In correct";
                }
            }
            else{
                echo "User not found";
            }

        }
        else{
            echo "The feilds are empty";
        }
        

        


        

        

    
    }
















?>