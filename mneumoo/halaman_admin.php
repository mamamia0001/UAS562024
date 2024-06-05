<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, username, password, level FROM login";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2C3539;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align:center;
            color: #333;
        }

        .navbar {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: right;
            position: relative;
        }

        .navbar a {
            color: #fff;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #575757;
        }

        .hamburger {
            display: inline-block;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 10px;
        }

        .bar {
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin: 5px 0;
            transition: 0.4s;
        }

        .menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 20px;
            background: #333;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .menu a {
            display: block;
            margin: 10px 0;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            table-layout: auto;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .editButton, .deleteButton {
            margin-left: 10px;
        }
    </style>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        function enableEditMode() {
            var rows = document.querySelectorAll("table tbody tr");
            rows.forEach(row => {
                if (!row.querySelector('.actionButton')) {
                    var editButton = document.createElement("button");
                    editButton.textContent = "Edit";
                    editButton.className = "editButton";
                    editButton.onclick = function() { editRow(row); };
                    
                    var deleteButton = document.createElement("button");
                    deleteButton.textContent = "Delete";
                    deleteButton.className = "deleteButton";
                    deleteButton.onclick = function() { deleteRow(row); };

                    var td = document.createElement("td");
                    td.appendChild(editButton);
                    td.appendChild(deleteButton);
                    row.appendChild(td);
                }
            });
        }

        function editRow(row) {
            var cells = row.querySelectorAll("td");
            var id = cells[0].textContent;
            var username = prompt("Enter new username:", cells[1].textContent);
            var password = prompt("Enter new password:", cells[2].textContent);
            
            if (username && password) {
                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "update_user.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        cells[1].textContent = username;
                        cells[2].textContent = password;
                    } else {
                        alert("Failed to update user");
                    }
                };
                xhr.send("id=" + id + "&username=" + username + "&password=" + password);
            }
        }

        function deleteRow(row) {
            var cells = row.querySelectorAll("td");
            var id = cells[0].textContent;
            if (confirm("Are you sure you want to delete this user?")) {
                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_user.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        row.remove();
                    } else {
                        alert("Failed to delete user");
                    }
                };
                xhr.send("id=" + id);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="hamburger" onclick="toggleMenu()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div id="menu" class="menu">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        
        <h2>Daftar Pengguna</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["username"] . "</td>
                                <td>" . $row["password"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <button onclick="enableEditMode()">Edit</button>
    </div>
</body>
</html>
