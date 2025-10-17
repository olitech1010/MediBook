<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
    <title>Login - MediBook Ghana</title>
    <style>
        body {
            background: url('img/login-background-image.jpg') center/cover no-repeat fixed;
            min-height: 100vh;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: -1;
        }
        
        .container {
            position: relative;
            z-index: 2;
            min-width: 320px;
            width: 100%;
            max-width: 500px;
            padding: 20px;
            box-sizing: border-box;
        }
        
        .container table {
            width: 100% !important;
            min-width: 280px;
        }
        
        .back-to-home {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }
        
        .back-to-home a {
            color: white;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .back-to-home a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
                margin: 20px auto;
            }
            
            .back-to-home {
                top: 10px;
                left: 10px;
            }
            
            .back-to-home a {
                padding: 8px 15px;
                font-size: 14px;
            }
            
            .input-text {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <?php
    // Start session
    session_start();

    // Unset all the server side variables
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";
    
    // Set the new timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;
    
    // Import database
    include("connection.php");
    include("password_utils.php");

    // Initialize error variable
    $error = '<label for="promter" class="form-label">&nbsp;</label>';

    if($_POST){
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        
        $error = '<label for="promter" class="form-label"></label>';

        // Use prepared statements to prevent SQL injection
        $stmt = $database->prepare("SELECT * FROM webuser WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows == 1){
            $utype = $result->fetch_assoc()['usertype'];
            
            if ($utype == 'p'){
                // Patient login
                $stmt = $database->prepare("SELECT * FROM patient WHERE pemail=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $checker = $stmt->get_result();
                
                if ($checker->num_rows == 1){
                    $patient = $checker->fetch_assoc();
                    $storedHash = $patient['ppassword'];
                    
                    // Verify password (support both hashed and legacy passwords)
                    if (verifyPassword($password, $storedHash) || $storedHash === $password){
                        // Patient dashboard
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'p';
                        
                        // If using legacy password, update to hashed version
                        if ($storedHash === $password) {
                            $hashedPassword = hashPassword($password);
                            $updateStmt = $database->prepare("UPDATE patient SET ppassword=? WHERE pemail=?");
                            $updateStmt->bind_param("ss", $hashedPassword, $email);
                            $updateStmt->execute();
                        }
                        
                        header('location: patient/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            } elseif($utype == 'a'){
                // Admin login
                $stmt = $database->prepare("SELECT * FROM admin WHERE aemail=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $checker = $stmt->get_result();
                
                if ($checker->num_rows == 1){
                    $admin = $checker->fetch_assoc();
                    $storedHash = $admin['apassword'];
                    
                    // Verify password
                    if (verifyPassword($password, $storedHash) || $storedHash === $password){
                        // Admin dashboard
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'a';
                        
                        // If using legacy password, update to hashed version
                        if ($storedHash === $password) {
                            $hashedPassword = hashPassword($password);
                            $updateStmt = $database->prepare("UPDATE admin SET apassword=? WHERE aemail=?");
                            $updateStmt->bind_param("ss", $hashedPassword, $email);
                            $updateStmt->execute();
                        }
                        
                        header('location: admin/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }

            } elseif($utype == 'd'){
                // Doctor login
                $stmt = $database->prepare("SELECT * FROM doctor WHERE docemail=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $checker = $stmt->get_result();
                
                if ($checker->num_rows == 1){
                    $doctor = $checker->fetch_assoc();
                    $storedHash = $doctor['docpassword'];
                    
                    // Verify password
                    if (verifyPassword($password, $storedHash) || $storedHash === $password){
                        // Doctor dashboard
                        $_SESSION['user'] = $email;
                        $_SESSION['usertype'] = 'd';
                        
                        // If using legacy password, update to hashed version
                        if ($storedHash === $password) {
                            $hashedPassword = hashPassword($password);
                            $updateStmt = $database->prepare("UPDATE doctor SET docpassword=? WHERE docemail=?");
                            $updateStmt->bind_param("ss", $hashedPassword, $email);
                            $updateStmt->execute();
                        }
                        
                        header('location: doctor/index.php');
                        exit();
                    } else {
                        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                    }
                } else {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
                }
            }
            
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
        }
    }
    ?>

    <div class="back-to-home">
        <a href="index.html">
            <i class="fas fa-arrow-left"></i>
            Back to Home
        </a>
    </div>
    
    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Welcome to MediBook Ghana</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="sub-text">Sign in to access your healthcare dashboard</p>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="" method="POST">
                        <table border="0" style="width: 100%;">
                            <tr>
                                <td class="label-td">
                                    <label for="useremail" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td">
                                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td">
                                    <label for="userpassword" class="form-label">Password: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td">
                                    <input type="password" name="userpassword" class="input-text" placeholder="Password" required>
                                </td>
                            </tr>
                            <tr>
                                <td><br>
                                <?php echo $error ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                    <br><br><br>
                </td>
            </tr>
        </table>
    </div>
    </center>
</body>
</html>