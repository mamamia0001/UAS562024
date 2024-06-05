<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "user";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    
    $sql = "UPDATE login SET password='$new_password' WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Password berhasil diubah.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lupa Sandi</title>
    
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
  <div class="container">
    <div class="logo">
      <img src="public/black-minimalist-studio-logo-11@2x.png" alt="Logo">
    </div>
</head>
<body>
    <h2>Lupa Sandi</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Username: <input type="text" name="username" required><br>
        Password Baru: <input type="password" name="new_password" required><br>
        <input type="submit" value="Ubah Password">
    </form>
</body>
</html>
