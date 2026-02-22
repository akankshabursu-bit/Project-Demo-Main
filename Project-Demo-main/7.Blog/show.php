<?php

/*******w******** 
    
    Name:Dingguo Du
    Date:2023/1/23
    Description:Blog

****************/

require('connect.php');

// Get the row data of title, content and id transferred by Get from index page when blog title was clicked.
if ($_GET && !empty($_GET['id']) && filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) 
{
   // Sanitize user input to escape HTML entities and filter out dangerous characters. 
   $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   
   // Build the parameterized SQL query and bind to the above sanitized values.
   $query = "SELECT * FROM blog WHERE id=(:id)";
   $statement = $db->prepare($query);
   $statement->bindValue(":id",$id);
   $statement->execute();

   // Execute the Select.
   $count=$statement->rowCount();

   // if no result was got from query.
   if($count==0)
   {
       header("Location: index.php");
       exit;
   }
   else
   {
       $row= $statement->fetch();
   }
}
else
{
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Document</title>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">My Amazing Blog!</a></h1>
        </div> 
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="create.php">New Post</a></li>
        </ul> 
        <div id="all_blogs">
            <div class="blog_post">
                <h2><?=$row['title']?></h2>
                <p>
                    <small>
                        <?=date('F d, Y, h:i a',strtotime($row['time']))?> - <a href="edit.php?id=<?=$row['id']?>">Edit</a>
                    </small>
                </p>
                <div class='blog_content'><?=$row['content']?></div>
            </div>
        </div>
        <div id="footer">
            Copywrong 2023 - No Rights Reserved
        </div> 
    </div> 
</body>
</html>