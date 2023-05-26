<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: ../");
    }
    $data = $_SESSION['data'];

    if($_SESSION['users']==1){
        $status = '<b style="color: green">Voted</b>';
    }
    else{
        $status = '<b style="color: red">Not Voted</b>';
    }

    function refresh(){
        session_destroy();
        $data = $_SESSION['data'];
    }
    

?>

<html>
    <head>
        <title>Online voting system - Dashboard</title>
        <link rel="stylesheet" href="../css/styles.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        
            <center>
            <div id="headerSection">
            <a href="../routes/admin.php"><button id="back-button"> Back</button></a>
            <a href="logout.php"><button id="logout-button">Logout</button></a>
            <h1>Online Voting System</h1>  
            </div>
            </center>
            <hr>

            <div id="mainSection">
                <div id="profileSection">
                    <center><img src="../uploads/<?php echo $data['photo']?>" height="100" width="100"></center><br>
                    <b>Name : </b><?php echo $data['name'] ?><br><br>
                    <b>CIN : </b><?php echo $data['cin'] ?><br><br>
                    <b>Address : </b><?php echo $data['address'] ?><br><br>
                </div>
                <div id="groupSection">
                <h2><Center>Users</Center></h2>
                    <?php

                    if(isset($_SESSION['users'])){
                        $users = $_SESSION['users'];
                        for($i=0; $i<count($users); $i++){
                            ?>
                                <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                                <img style="float: right" src="../uploads/<?php echo $users[$i]['photo']?>" height="80" width="80">
                                <b>User : </b><?php echo $users[$i]['name']?><br><br>
                                <b>Cin :</b> <?php echo $users[$i]['cin']?><br><br>

                                <?php

                                if($users[$i]['role']==1){
                                    ?>
                                    <b>Role :</b> Electeur <br><br>
                                    <?php
                                }
                                else{
                                    ?>
                                    <b>Role :</b> Candidat <br><br>
                                    <?php
                                }
                                ?>

                                <b>Address :</b> <?php echo $users[$i]['address']?><br><br>

                                <?php

                                if($users[$i]['status']==1){
                                    ?>
                                    <b>Status :</b> Voted <br><br>
                                    <?php
                                }
                                else{
                                    ?>
                                    <b>Status :</b> Not Voted <br><br>
                                    <?php
                                }
                                ?>
                                <form action="process.php" methode="GET">
                                <button id="btn-del" onclick="refresh()" type="submit" name="user_del" value="<?= $users[$i]['id'] ?>">Delete</button>
                                </form>

                                </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                            <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                                <b>No groups available right now.</b>    
                            </div>
                        <?php
                    }  
                    ?>
                </div>
            </div> 
    </body>
</html>
<script>
function refresh(){
    $.ajax({url:"manage_user.php", success:function(result){
    $("div").text(result);}
})
} 
</script>