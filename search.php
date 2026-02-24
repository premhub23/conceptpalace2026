<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin:0;
            background:#f4f6f9;
        }

        .container {
            width:90%;
            max-width:1100px;
            margin:auto;
            padding:20px;
        }

        .search-box {
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            margin-bottom:20px;
        }

        .search-box input {
            flex:1;
            padding:12px;
            font-size:16px;
        }

        .search-box button {
            padding:12px 20px;
            background:#007bff;
            border:none;
            color:white;
            cursor:pointer;
        }

        .card {
            background:white;
            border-radius:8px;
            overflow:hidden;
            margin-bottom:20px;
            display:flex;
            flex-wrap:wrap;
            box-shadow:0 3px 8px rgba(0,0,0,0.1);
            transition:0.3s;
        }

        .card:hover {
            transform:scale(1.02);
        }

        .card img {
            width:200px;
            object-fit:cover;
        }

        .card-content {
            padding:15px;
            flex:1;
        }

        .type {
            font-size:14px;
            font-weight:bold;
            color:#28a745;
        }

        .card a {
            text-decoration:none;
            color:black;
        }

        @media(max-width:768px){
            .card {
                flex-direction:column;
            }

            .card img {
                width:100%;
                height:200px;
            }
        }
    </style>
</head>
<body>

<div class="container">

<h2>🔎 Search</h2>

<form method="GET" class="search-box">
    <input type="text" name="keyword" placeholder="Search products, news, gallery..." required>
    <button type="submit">Search</button>
</form>

<?php
if(isset($_GET['keyword'])){

    $keyword = trim($_GET['keyword']);
    $searchTerm = "%".$keyword."%";

    $conn = mysqli_connect("localhost","root","","conceptpalace2025");

    if(!$conn){
        die("Connection failed");
    }

    $sql = "
    SELECT 'product' AS type, product_id AS id, name AS title,
           description AS details, image AS img
    FROM products
    WHERE name LIKE ? OR description LIKE ? OR category LIKE ?

    UNION

    SELECT 'news' AS type, news_events_id AS id, title,
           body AS details, news_path AS img
    FROM news_events
    WHERE title LIKE ? OR body LIKE ?

    UNION

    SELECT 'ansil' AS type, ansil_id AS id, image_name,
           image_path AS details, image_path AS img
    FROM ansil
    WHERE image_name LIKE ?

    UNION

    SELECT 'jonathan' AS type, jonathan_id AS id, image_name,
           image_path AS details, image_path AS img
    FROM jonathan
    WHERE image_name LIKE ?

    UNION

    SELECT 'premchand' AS type, premchand_id AS id, image_name,
           image_path AS details, image_path AS img
    FROM premchand
    WHERE image_name LIKE ?
    ";

    $stmt = mysqli_prepare($conn,$sql);

    mysqli_stmt_bind_param($stmt,"ssssssss",
        $searchTerm,$searchTerm,$searchTerm,
        $searchTerm,$searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm
    );

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result)>0){

        while($row = mysqli_fetch_assoc($result)){

            // Generate correct link
            if($row['type']=="product"){
                $link = "product.php?id=".$row['id'];
            }
            elseif($row['type']=="news"){
                $link = "news_details.php?id=".$row['id'];
            }
            else{
                $link = "gallery_details.php?type=".$row['type']."&id=".$row['id'];
            }

            echo "<a href='$link'>";
            echo "<div class='card'>";

            if(!empty($row['img'])){
                echo "<img src='".$row['img']."' alt='Image'>";
            }

            echo "<div class='card-content'>";
            echo "<div class='type'>".strtoupper($row['type'])."</div>";
            echo "<h3>".$row['title']."</h3>";
            echo "<p>".substr($row['details'],0,150)."...</p>";
            echo "</div>";

            echo "</div>";
            echo "</a>";
        }

    } else {
        echo "<p style='color:red;'>No results found.</p>";
    }

    mysqli_close($conn);
}
?>

</div>
</body>
</html>