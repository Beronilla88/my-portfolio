<?php
require_once "config.php";


$username = $password = $confirm_password = $lastName = $firstName = $middleName = $email = $age = $birthday = $phoneNumber = "";
$username_err = $password_err = $confirm_password_err = $lastName_err = $firstName_err = $middleName_err = $email_err = $age_err = $birthday_err = $phoneNumber_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
}
else{

    $sql = "SELECT id FROM users WHERE username = ?";
    
    if($stmt = mysqli_prepare($sqlink, $sql)){
      
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
      
        $param_username = trim($_POST["username"]);
        
     
        if(mysqli_stmt_execute($stmt)){
          
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        

      
        mysqli_stmt_close($stmt);
    }
}


if (empty(trim($_POST["last_name"]))) {
    $lastName_err = "Please enter your Last Name.";
} else {
    $lastName = trim($_POST["last_name"]);
}


if (empty(trim($_POST["first_name"]))) {
    $firstName_err = "Please enter your First Name.";
} else {
    $firstName = trim($_POST["first_name"]);
}


if (empty(trim($_POST["middle_name"]))) {
    $middleName_err = "Please enter your Middle Name.";
} else {
    $middleName = trim($_POST["middle_name"]);
}


if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter your Email.";
} elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
    $email_err = "Invalid email format.";
} else {
    $email = trim($_POST["email"]);
}


if (empty(trim($_POST["age"]))) {
    $age_err = "Please enter your Age.";
} else {
    $age = trim($_POST["age"]);
}


if (empty(trim($_POST["birthday"]))) {
    $birthday_err = "Please enter your Birthday.";
} else {
    $birthday = trim($_POST["birthday"]);
}


if (empty(trim($_POST["phone_number"]))) {
    $phoneNumber_err = "Please enter your Phone Number.";
} else {
    $phoneNumber = trim($_POST["phone_number"]);
}


if (isset($_POST["password"]) && !empty(trim($_POST["password"]))) {
    $password = trim($_POST["password"]);
} else {
    $password_err = "Please enter a password.";
}


if (isset($_POST["confirm_password"]) && !empty(trim($_POST["confirm_password"]))) {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
        $confirm_password_err = "Password did not match.";
    }
} else {
    $confirm_password_err = "Please confirm password.";
}

echo $sql;


if (empty($username_err) && empty($password_err) && empty($confirm_password_err) &&
    empty($lastName_err) && empty($firstName_err) && empty($middleName_err) &&
    empty($email_err) && empty($age_err) && empty($birthday_err) && empty($phoneNumber_err)) {
    

    $sql = "INSERT INTO users (username, password, lastName, firstName, middleName, email, age, birthday, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
     
    if ($stmt = mysqli_prepare($sqlink, $sql)) {

        mysqli_stmt_bind_param($stmt, "ssssssiss", $param_username, $param_password, $param_last_name, $param_first_name, $param_middle_name, $param_email, $param_age, $param_birthday, $param_phone_number);
        

        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); 
        $param_last_name = $lastName;
        $param_first_name = $firstName;
        $param_middle_name = $middleName;
        $param_email = $email;
        $param_age = $age;
        $param_birthday = $birthday;
        $param_phone_number = $phoneNumber;


        if (mysqli_stmt_execute($stmt)) {

            header("location: login.php");
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}



mysqli_close($sqlink);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.8">
        <title>Sign Up - Spoodify</title>
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

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url("../images/regbg.jpg");
    background-size: cover;
    background-position: center;
    
}

.wrapper {
    width: 700px;
    background: transparent;
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    backdrop-filter: blur(50px);
    border-radius: 10px;
    color: white;
    padding: 20px 35px 20px;
}

.wrapper i{
    font-size: 70px;
    position:absolute;
}
.wrapper h1 {
    font-size: 36px;
    text-align: center;
    margin-bottom: 20px;
}

.wrapper .input-box{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.input-box .input-field{
    position: relative;
    width: 48%;
    height: 50px;
    margin: 13px 0;
}

.input-box .input-field input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    outline: none;
    font-size: 16px;
    color: white;
    border-radius: 6px;
    padding: 15px 15px 15px 40px;
}

.input-box .input-field input::placeholder{
    color: white
}

.gender-title{
    color: white;
    font-size: 24px;
    font-weight: 600;
    border-bottom: 1px solid white;
}

.gender-category{
    margin: 15px 0;
}

.gender-category label{
    padding: 0 20px 0 5px;
}

.input-box .input-field i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.wrapper label{
    display: inline-block;
    font-size: 14.5px;
    margin: 10px 0 23px;
}

.wrapper label input{
    accent-color: white;
    margin-right: 5px;
}

.wrapper .btn{
    width: 100%;
    height: 45px;
    background: white;
    border: none;
    outline: none;
    border-radius: 6px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: black;
    font-weight: 600;
}

#alr{
    margin-top: 10px;
}
#alr a{
    text-decoration: none;
    color: #cb1fee;
}
#shopass{
    margin-left: 500px;
}
    </style>
</head>
<body>
<div class="wrapper">
    <i class='bx bxs-cat'></i>
    <h1>Registration</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="input-box">
            <div class="input-field">
                    <input type="text" placeholder="Last Name" name="last_name" required class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                    <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="First Name" name="first_name" required class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                    <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Middle Name" name="middle_name" required class="form-control <?php echo (!empty($middleName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $middleName; ?>">
                    <span class="invalid-feedback"><?php echo $middleName_err; ?></span>
                </div>
                <div class="input-field">
                    <input type="email" placeholder="Email" name="email" required class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    <i class='bx bxs-envelope'></i>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="number" placeholder="Age" name="age" required class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $age; ?>">
                    <span class="invalid-feedback"><?php echo $age_err; ?></span>
                </div>
                <div class="input-field">
                    <input type="date" placeholder="Birthday" name="birthday" required class="form-control <?php echo (!empty($birthday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $birthday; ?>">
                    <span class="invalid-feedback"><?php echo $birthday_err; ?></span>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="User Name" name="username" required class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-field">
                        <input type="number" placeholder="Phone Number" name="phone_number" required class="form-control <?php echo (!empty($phoneNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneNumber; ?>">
                        <span class="invalid-feedback"><?php echo $phoneNumber_err; ?></span>
                        <i class='bx bxs-phone-call'></i>
                    </div>
                </div>

                <div class="input-box">
                    <div class="input-field">
                    <input type="password" placeholder="Password" id="password" required name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-field">
                    <input type="password" placeholder="Confirm Password" id="confirm_password" required name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

                        <i class='bx bxs-lock-alt'></i>
                    </div>
                </div>

                <label><input type="checkbox" onchange="Password()" id="shopass">Show Password </label>

               

                <div class="register-link">
                <input type="submit" class="btn btn-primary" value="Submit"><br><br>
            
            <p id="alr">Already have an account? <a href="login.php">Login Now</a>.</p>
            </div>

            </form>
        </div>

<script>
            function Password() {
                var passwordInput = document.getElementById("password");
                var passwordInput2 = document.getElementById("confirm_password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
                
                if (passwordInput2.type === "password") {
                    passwordInput2.type = "text";
                } else {
                    passwordInput2.type = "password";
                }
            }
        </script>
</body>
</html>

</body>