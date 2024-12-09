<?php
if (isset($_POST['delete'])) {
    $conn = new mysqli("localhost", "root", "", "Lab_5b");
    $sql = "DELETE FROM users WHERE matric = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_POST['matric']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: display page.php");
    exit();
}
?>
<!-- Add Update and Delete Buttons in Table -->
<tr>
    <td><?php echo $row['matric']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['role']; ?></td>
    <td>
        <form method="POST" action="">
            <input type="hidden" name="matric" value="<?php echo $row['matric']; ?>">
            <button type="submit" name="delete">Delete</button>
        </form>
    </td>
</tr>
