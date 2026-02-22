<?php

/*******w******** 
    
    Name:Dingguo Du
    Date:2023/1/23
    Description:Blog

****************/

require('connect.php');
require('authenticate.php');

// Get the row data of title, content and id transferred by Get from index page when edit button triggered.
if ($_GET && !empty($_GET['id'])&& filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) 
{
   // Sanitize user input to escape HTML entities and filter out dangerous characters.
   $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
   
   // Build the parameterized SQL query and bind to the above sanitized values.
   $query = "SELECT * FROM blog WHERE id=(:id)";
   $statement = $db->prepare($query);
   $statement->bindValue(":id",$id);

   // Execute the Select.
   $statement->execute();

   // Check the count of rows from query result.
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
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">My Amazing Blog!</a></h1>
        </div> 

        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="create.php">New Post</a></li>
        </ul> 

        <div id="all_blogs">
            <form action="process_post.php" method="post">
                <fieldset>
                    <legend>Edit Blog Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title" value="<?=$row['title']?>"> 
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content"><?=$row['content']?></textarea>
                    </p>
                    <p>
                        <input type="hidden" name="id" value=<?=$row['id']?>>
                        <input type="submit" name="command" value="Update">
                        <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')">
                    </p>
                </fieldset>
            </form>
        </div>

        <div id="footer">
            Copywrong 2023 - No Rights Reserved
        </div> 
    </div>
</body>
</html>