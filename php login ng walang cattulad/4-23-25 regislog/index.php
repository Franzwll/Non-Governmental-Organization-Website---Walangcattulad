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
        <ul class="list-unstyled">
            <?php
            // Example data for upcoming events
            $events = [
            ["title" => "Pagkain for Every Juan", "date" => "2024-10-15"],
            ["title" => "Sa9ip Buhay", "date" => "2024-08-20"],
            ["title" => "TBA", "date" => "TBA"]
            ];

            foreach ($events as $event) {
            echo "<li><strong>" . htmlspecialchars($event['title']) . "</strong> - " . htmlspecialchars($event['date']) . "</li>";
            }
            ?>
        </ul>

        <h6 class="mt-4">Thank you for your contributions!</h6>

        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>