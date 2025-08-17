<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container bg-white p-4 rounded text-center">
        <h1>Welcome to Volunteer's Dashboard</h1>
        <h2>Upcoming Events/Causes</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Example data for registered volunteers
            $volunteers = [
                ["id" => 1, "full_name" => "Juan Dela Cruz", "email" => "juan@example.com"],
                ["id" => 2, "full_name" => "Maria Clara", "email" => "maria@example.com"],
                ["id" => 3, "full_name" => "Jose Rizal", "email" => "jose@example.com"]
            ];

            foreach ($volunteers as $volunteer) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($volunteer['full_name']) . "</td>";
                echo "<td>" . htmlspecialchars($volunteer['email']) . "</td>";
                echo "<td>";
                echo "<a href='update.php?id=" . htmlspecialchars($volunteer['id']) . "' class='btn btn-primary btn-sm'>Update</a> ";
                echo "<a href='delete.php?id=" . htmlspecialchars($volunteer['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this volunteer?\")'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <h6 class="mt-4">Thank you for your contributions!</h6>

        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>