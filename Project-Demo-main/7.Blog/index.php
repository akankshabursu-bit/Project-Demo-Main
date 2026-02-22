<?php

/*******w******** 
    
    Name:Dingguo Du
    Date:2023/1/23
    Description:Blog

****************/

require('connect.php');

// SQL is written as a String.
$query = "SELECT * FROM blog ORDER BY id DESC";

// A PDO::Statement is prepared from the query.
$statement = $db->prepare($query);

// Execution on the DB server is delayed until we execute().
$statement->execute(); 

// Check the count of rows in query result.
$count=$statement->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css" type="text/css">
    <title>Welcome to my blog</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">

        <div id="header">
            <h1><a href="index.php">My Amazing Blog!</a></h1>
        </div>

        <ul id="menu">
            <li><a href="index.php" class='active'>Home</a></li>
            <li><a href="create.php">New Post</a></li>
        </ul>

        <?php if($count !=0):?>
            <div id="all_blogs">
                <?php $count=0?>
                <?php while(($row = $statement -> fetch()) && ($count<5)):?>
                    <div class="blog_post">
                        <?php $count++ ?>
                        <h2><a href="show.php?id=<?=$row['id']?>"><?=$row['title']?></a></h2>
                        <p>
                            <small>
                            <?=date('F d, Y, h:i a',strtotime($row['time']))?> - <a href="edit.php?id=<?=$row['id']?>">Edit</a>
                            </small>
                        </p>
                        <div class='blog_content'>
                            <?php if(strlen($row['content'])>200):?>
                                <?=substr($row['content'],0,200)?> ...<a href="show.php?id=<?=$row['id']?>">Read more</a>
                            <?php else:?>
                                <?=$row['content']?>
                            <?php endif?>
                        </div>
                    </div>
                <?php endwhile?>
            </div>
        <?php endif?>

        <div id="footer">
            Copywrong 2023 - No Rights Reserved
        </div> 

    </div> 
</body>
</html>