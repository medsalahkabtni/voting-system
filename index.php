<html>
    <head>
        <title>Online voting system - Home</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
            <center>
            <div id="headerSection">
            <h1>Online Voting System</h1>  
            </div>
            <hr>
            
            <div id="loginSection"> 
            <h2>Login</h2>
                <form action="api/login.php" method="POST">
                    <input type="number" name="cin" placeholder="Enter CIN" required><br><br>
                    <input type="password" name="pass" placeholder="Enter password" required><br><br>
                    <select name="role" style="width: 20%; border: 2px solid black">
                        <option value="1">Electeur</option>
                        <option value="2">Candidat</option>
                        <option value="3">Admin</option>
                    </select><br><br>                  
                    <button id="loginbtn" type="submit" name="loginbtn">Login</button><br><br>
                    New user? <a href="routes/register.php">Register here</a>
                </form>
            </div>  
            </center> 
    </body>
</html>