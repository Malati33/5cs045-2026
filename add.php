<?php
include 'database.php';

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $studio = $_POST['studio'];
    $genre = $_POST['genre'];
    $year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $image = $_POST['image'];

    $stmt = $conn->prepare(
        "INSERT INTO animations
        (title, studio, genre, release_year, rating, image)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssiss",
        $title,
        $studio,
        $genre,
        $year,
        $rating,
        $image
    );

    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Animation</title>
</head>

<body>

<h1>Add Animation</h1>

<form method="POST">

<input type="text" name="title" placeholder="Title" required><br><br>

<input type="text" name="studio" placeholder="Studio" required><br><br>

<input type="text" name="genre" placeholder="Genre" required><br><br>

<input type="number" name="release_year" placeholder="Year" required><br><br>

<input type="text" name="rating" placeholder="Rating"><br><br>

<input type="text" name="image" placeholder="Image URL"><br><br>

<button type="submit" name="submit">
Add Animation
</button>

</form>

</body>
</html>