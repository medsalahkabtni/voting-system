<?php
    include("connection.php");

    $name = $_POST['name'];
    $cin = $_POST['cin'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $add = $_POST['add'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];


    $check = pg_query($connect,"select * from public.user where cin=$cin");
    $test = pg_num_rows($check);

    if($cpass!=$pass){
        echo '<script>
                alert("Passwords do not match!");
                window.location = "../routes/register.php";
            </script>';
    }
    elseif(strlen($cin)!=8){
        echo '<script>
                alert("Numero CIN incorrect!");
                window.location = "../routes/register.php";
            </script>';
    }
    elseif(($test)>0){
        echo '<script>
                alert("Numero CIN déjà inscrit!");
                window.location = "../routes/register.php";
            </script>';
    }
    else{
        move_uploaded_file($tmp_name,"../uploads/$image");
        $insert = pg_query($connect, "insert into public.user (name, cin, password, address, photo, status, votes, role) values('$name', $cin, '$pass', '$add', '$image', 0, 0, $role)");
        if($insert){
            echo '<script>
                    alert("Registration successfull!");
                    window.location = "../";
                </script>';
        }
    }
    
?>