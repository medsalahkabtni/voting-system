<?php
    session_start();
    include("connection.php");

    $cin = $_POST['cin'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    $check = pg_query($connect, "select * from public.user where cin=$cin and password=$pass and role=$role ");

    if(pg_num_rows($check)>0){
        $getGroups = pg_query($connect, "select name, photo, votes, id from public.user where role=2 ");
        
        if(pg_num_rows($getGroups)>0){
            $groups = pg_fetch_all($getGroups);
            $_SESSION['groups'] = $groups;
        }
        $getUsers = pg_query($connect, "select name, photo, cin, id, address, status, role from public.user where role!=3 ");
        if(pg_num_rows($getUsers)>0){
            $users = pg_fetch_all($getUsers);
            $_SESSION['users'] = $users;
        }
    
        $data = pg_fetch_array($check);
        $_SESSION['id'] = $data['id'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['data'] = $data;
        if(($role)==3){
        echo '<script>
                window.location = "../routes/admin.php";
            </script>';
        }
        else{
            echo '<script>
                window.location = "../routes/dashboard.php";
            </script>';
        }
    }
    else{
        echo '<script>
                alert("Invalid credentials!");
                window.location = "../";
            </script>';
    }
    
?>