<?php

session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../main.php");
    exit;
}
 

require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty($username_err) && empty($password_err)){

        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($sqlink, $sql)){

            mysqli_stmt_bind_param($stmt, "s", $param_username);
            

            $param_username = $username;
            
 
            if(mysqli_stmt_execute($stmt)){

                mysqli_stmt_store_result($stmt);
                

                if(mysqli_stmt_num_rows($stmt) == 1){                    
      
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
               
                            session_start();
                            
                  
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                      
                            header("location: ../main.php");
                        } else{
                  
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
               
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }


            mysqli_stmt_close($stmt);
        }
    }
    

    mysqli_close($sqlink);
}
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.8">
        <title>Login</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' 
        rel='stylesheet'>
    </head>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url("../images/regbg.jpg");
    background-size: cover;
    background-position: center;
}

.wrapper {
    width: 420px;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    color: white;
    border-radius: 10px;
    padding: 30px 40px;
}
.wrapper h1 {
    font-size: 36px;
    text-align: center;
}
.wrapper #down {
    font-size: 15px;
    text-align: center;
}
.wrapper i{
    font-size: 50px;
    position:absolute;
}

.wrapper h1 {
    font-size: 36px;
    text-align: center;
}

.wrapper .input-box {
    position: relative;
    width: 100%;
    height: 50px;
    margin: 30px 0;
}

.input-box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px;
    font-size: 16px;
    color: white;
    padding: 20px 45px 20px 20px;
}

.input-box input::placeholder{
    color: white;
}

.input-box i{
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.wrapper .show-pass{
    display: flex;
    justify-content: space-between;
    font-size: 14.5px;
    margin: 15px 0 15px;
}

.show-pass label input{
    accent-color: white;
    margin-right: 3px;
}

.show-pass a {
    color: white;
    text-decoration: none;
}

.show-pass a:hover {
    text-decoration: underline;
}

.wrapper .btn {
    width: 100%;
    height: 45px;
    background: white;
    border: none;
    outline: none;
    border-radius: 48px;
    box-shadow: 0 0 10px rgba(0, 0 , 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
}

.wrapper .register-link{
    font-size: 14.5px;
    text-align: center;
    margin-top: 20px 0 15px;
}

.register-link p a{
    color: white;
    text-decoration: none;
    font-weight: 600;
}

.register-link p a:hover{
    text-decoration: underline;
}
    </style>
    <body>
        <div class="wrapper">
        

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger" id="down">' . $login_err . '</div>';
        }        
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <i class='bx bxs-cat'></i>
                <h1>Sign In</h1>
        <p id="down">Please fill in your credentials to login.</p>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <i class='bx bxs-user'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Password" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    <i class='bx bxs-lock-alt' ></i>
                </div>

                <div class="show-pass">
                    <label><input type="checkbox" onchange="Password()"> Show Password</label>
                    <a href="passwordReset.html">Need help?</a> 
                </div>

                <button type="submit" class="btn">Login</button>

                <div class="register-link">
                <p>New to KKK? <a href="register.php">Sign up now</a>.</p>
                </div>
        </div>
        </form>
        <script>
            function Password() {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            }
        </script>
        
    </body>
</html>