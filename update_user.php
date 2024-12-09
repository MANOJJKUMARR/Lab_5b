<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $conn = new mysqli("localhost", "root", "", "Lab_5b");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Form data
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $role = $_POST['role'];

        // Update SQL query
        $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $role, $matric);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>Update successful!</p>";
        } else {
            echo "<p style='color: red;'>Update failed: " . $conn->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    } elseif (isset($_POST['cancel'])) {
        header("Location: display_users.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
            text-align: left;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            width: 48%;
            padding: 12px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px 1%;
        }

        button:hover {
            background-color: #45a049;
        }

        .cancel {
            background-color: #f44336;
        }

        .cancel:hover {
            background-color: #e53935;
        }

        .error, .success {
            font-size: 14px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Update User</h1>
    <form method="POST" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required><br>

        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Access Level:</label>
        <select name="access level" required>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br>

        <button type="submit" name="update">Update</button>
        <button type="submit" name="cancel" class="cancel">Cancel</button>
    </form>
</div>

</body>
</html>
