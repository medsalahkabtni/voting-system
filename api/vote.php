<?php
    session_start();
    include("connection.php");

    $votes = $_POST['gvotes'];
    $total_votes= $votes+1;
    $gid = $_POST['gid'];
    $uid = $_SESSION['id'];

    
    if (isset($_POST['submit']) && $_POST['g-recaptcha-response'] != "") {
        
        $secret = '6LcrznkdAAAAAO2T4pLyewDznGMMWqE6WMB87rvd';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if ($responseData->success) {
    
    
            $update_votes = pg_query($connect, "update public.user set votes=$total_votes where id=$gid");
            $update_status = pg_query($connect, "update public.user set status=1 where id=$uid");
        }
    }else{
        echo'<script>
                 alert("You are a robot ?");
                </script>';
    }

    
    if($update_status and $update_votes){
        $getGroups = pg_query($connect, "select name, photo, votes, id from public.user where role=2 ");
        $groups = pg_fetch_all($getGroups);
        $_SESSION['groups'] = $groups;
        $_SESSION['status'] = 1;
        echo '<script>
                    alert("Voting successfull!");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    else{
        echo '<script>
                    alert("Voting failed!.. Try again.");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    
?>