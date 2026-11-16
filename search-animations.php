<?php
include 'database.php';

if(isset($_POST['keywords']) && !empty($_POST['keywords']))
{
    $keywords = mysqli_real_escape_string($conn, $_POST['keywords']);

    $sql = "
        SELECT *
        FROM animations
        WHERE title LIKE '%$keywords%'
        OR studio LIKE '%$keywords%'
        OR genre LIKE '%$keywords%'
        ORDER BY release_year
    ";
}
else
{
    $sql = "SELECT * FROM animations ORDER BY release_year";
}

$results = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Search Animations</title>

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

.searching{
    text-align:center;
    margin:20px;
}

.searching input[type="text"]{
    padding:10px;
    width:300px;
    border:none;
    border-radius:8px;
}

.searching input[type="submit"]{
    padding:10px 20px;
    background:#06d6a0;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
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
    box-shadow:0 5px 15px rgba(0,0,0,.5);
    transition:.3s;
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
    margin-top:0;
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

.back{
    display:inline-block;
    margin:20px;
    background:#06d6a0;
    color:white;
    padding:10px 15px;
    text-decoration:none;
    border-radius:8px;
}
</style>

</head>
<body>

<h1>🎬 Animation Collection Search</h1>

<div class="searching">
    <form action="search-animations.php" method="POST">
        <input type="text" name="keywords" placeholder="Search animation...">
        <input type="submit" value="🔍 Search">
    </form>
</div>

<a class="back" href="index.php">⬅ Back to Home</a>

<div class="container">

<?php
if(mysqli_num_rows($results) > 0)
{
    while($row = mysqli_fetch_assoc($results))
    {
?>
        <div class="card">

            <img src="<?php echo $row['image']; ?>" alt="Animation">

            <div class="content">

                <h2><?php echo $row['title']; ?></h2>

                <p>🏢 Studio: <?php echo $row['studio']; ?></p>

                <p>🎭 Genre: <?php echo $row['genre']; ?></p>

                <p>📅 Year: <?php echo $row['release_year']; ?></p>

                <p>⭐ Rating: <?php echo $row['rating']; ?></p>

                <a class="edit"
                   href="edit.php?id=<?php echo $row['id']; ?>">
                   Edit
                </a>

                <a class="delete"
                   href="delete.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Delete this animation?')">
                   Delete
                </a>

            </div>

        </div>
<?php
    }
}
else
{
    echo "<h2 style='text-align:center;width:100%;'>No animations found.</h2>";
}
?>

</div>

</body>
</html>