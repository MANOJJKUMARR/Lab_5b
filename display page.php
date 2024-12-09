<?php
// Database connection details
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data from the users table
$sql = "SELECT matric, name, role AS accessLevel FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Table</title>
    <style>
        table {
            width: 70%;
            border-collapse: separate;
            margin: 5px auto;
            margin-left: 0;
        }
        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .update {
            background-color: #4CAF50; 
        }
        .delete {
            background-color: #f44336; 
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th>Actions</th>
        </tr>
        <?php
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['matric']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['accessLevel']}</td>
                        <td>
                            <a class='update' href='update_user.php?matric={$row['matric']}'>Update</a>
                            <a class='delete' href='delete_user.php?matric={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
           echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
