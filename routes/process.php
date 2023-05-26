<?php

include("connection.php");

if(isset($_GET['user_del'])){
    $id_del=$_GET['user_del'];

    $result = pg_query($connect,"delete from public.user where id=$id_del");

    
    if($result== true){
        echo '<script>
                alert("User delete success");
                window.location = "../routes/manage_user.php";
            </script>';

    }
    else{
        echo '<script>
                alert("error");
            </script>';
        header('Location: manage_user.php');
        exit(0);
    }

}

?>