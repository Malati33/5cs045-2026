<?php
include 'database.php';

$id = $_GET['id'];

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $studio = $_POST['studio'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $rating = $_POST['rating'];
    $image = $_POST['image'];

    $stmt = $conn->prepare(
        "UPDATE animations
         SET title=?, studio=?, genre=?, release_year=?, rating=?, image=?
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssissi",
        $title,
        $studio,
        $genre,
        $release_year,
        $rating,
        $image,
        $id
    );

    $stmt->execute();

    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM animations WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Animation</title>

<style>
body{
    font-family:Arial,sans-serif;
    background:#0f172a;
    color:white;
    padding:30px;
}

form{
    width:500px;
    margin:auto;
    background:#1e293b;
    padding:20px;
    border-radius:15px;
}

input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
    border:none;
    border-radius:8px;
}

button{
    background:#118ab2;
    color:white;
    padding:12px;
    border:none;
    border-radius:8px;
    width:100%;
    cursor:pointer;
}

h1{
    text-align:center;
}
</style>
</head>

<body>

<h1>✏️ Edit Animation</h1>

<form method="POST">

<input
type="text"
name="title"
value="<?php echo $row['title']; ?>"
required>

<input
type="text"
name="studio"
value="<?php echo $row['studio']; ?>"
required>

<input
type="text"
name="genre"
value="<?php echo $row['genre']; ?>"
required>

<input
type="number"
name="release_year"
value="<?php echo $row['release_year']; ?>"
required>

<input
type="text"
name="rating"
value="<?php echo $row['rating']; ?>">

<input
type="text"
name="image"
value="<?php echo $row['image']; ?>">

<button type="submit" name="update">
Update Animation
</button>

</form>

</body>
</html>