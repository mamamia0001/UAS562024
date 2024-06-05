<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    body {
      background-image: url("public/kayu-1@2x.png");
      background-size: cover;
      background-position: center;
      height: 100vh;
      font-family: 'Poppins', sans-serif; 
    }

    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      padding: 30px;
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .logo img {
      width: 200px;
      height: auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #fff;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: left;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #fff;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif; 
    }

    button {
      background-color: #FFB700;
      color: white;
      padding: 10px 20px;
      margin-top: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-family: 'Poppins', sans-serif; 
    }

    button:hover {
      background-color: #57A6A1;
    }

    .login {
      background-color: #74512D;
      color: white;
    }
  </style>
</head>
<body>
    <form action="register.php" method="POST">
    <div class="container">
    <div class="logo">
      <img src="public/black-minimalist-studio-logo-11@2x.png" alt="Logo">
    </div>
        <h2 class="h2">Register</h2>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <label for="level">Level</label>
        <select id="level" name="level" required>
            <option value="customer">customer</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" value="Register"onclick="window.location.href='register.php'">
        <input type="button" value="Login" onclick="window.location.href='index.php'">
 
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];
        
        
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "user";

        
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $sql = "INSERT INTO login (username, password, level) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $level);

        if ($stmt->execute()) {
            echo "Registrasi Berhasil!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>