<?php
include 'database.php';

$result = $conn->query("SELECT * FROM animations");

if(!$result){
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Animation Collection</title>

<style>
body{
    background:#0f172a;
    font-family:Arial,sans-serif;
    color:white;
    margin:0;
}

h1{
    text-align:center;
    background:#ff006e;
    padding:20px;
    margin:0;
}

.addbtn{
    display:block;
    width:220px;
    margin:20px auto;
    text-align:center;
    background:#06d6a0;
    color:white;
    padding:12px;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
}

.container{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:20px;
    padding:20px;
}

.card{
    width:280px;
    background:#1e293b;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.5);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-10px);
}

.card img{
    width:100%;
    height:350px;
    object-fit:cover;
}

.content{
    padding:15px;
}

.content h2{
    color:#ffd166;
}

.edit{
    background:#118ab2;
    color:white;
    padding:8px 12px;
    text-decoration:none;
    border-radius:5px;
    margin-right:5px;
}

.delete{
    background:red;
    color:white;
    padding:8px 12px;
    text-decoration:none;
    border-radius:5px;
}
</style>

</head>
<body>

<h1>🎬 Animation Collection</h1>

<a href="add.php" class="addbtn">
➕ Add Animation
</a>

<div class="container">

<?php
while($row = $result->fetch_assoc()){
?>

<div class="card">

<img src="<?php echo $row['image']; ?>" alt="Animation">

<div class="content">

<h2><?php echo $row['title']; ?></h2>

<p>🏢 Studio: <?php echo $row['studio']; ?></p>

<p>🎭 Genre: <?php echo $row['genre']; ?></p>

<p>📅 Year: <?php echo $row['release_year']; ?></p>

<p>⭐ Rating: <?php echo $row['rating']; ?></p>

<a class="edit" href="edit.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<a class="delete" href="delete.php?id=<?php echo $row['id']; ?>">
Delete
</a>

</div>
</div>

<?php
}
?>

</div>

</body>
</html>