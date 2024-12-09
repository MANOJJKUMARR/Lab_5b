<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $conn = new mysqli("localhost", "root", "", "Lab_5b");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the matric from the form
        $matric = $_POST['matric'];

        // Delete SQL query
        $sql = "DELETE FROM users WHERE matric = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $matric);

        if ($stmt->execute()) {
            echo "Delete successful!";
        } else {
            echo "Delete failed: " . $conn->error;
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
<html>
<head>
    <title>Delete User</title>
</head>
<body>
    <h1>Delete User</h1>
    <form method="POST" action="">
        <label>Matric:</label><input type="text" name="matric" required><br>
        <button type="submit" name="delete">Delete</button>
        <button type="submit" name="cancel">Cancel</button>
    </form>
</body>
</html>
