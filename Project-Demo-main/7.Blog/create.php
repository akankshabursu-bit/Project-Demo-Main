<?php

/*******w******** 
    
    Name:Dingguo Du
    Date:2023/1/23
    Description:Blog

****************/
require('authenticate.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css" type="text/css">
    <title>My Blog Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">My Amazing Blog!</a></h1>
        </div>        
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="create.php" class='active'>New Post</a></li>
        </ul>
        <div id="all_blogs">
            <form action="process_post.php" method="post">
                <fieldset>
                    <legend>New Blog Post</legend>
                    <p>
                        <label for="title">Title</label>
                        <input name="title" id="title">
                    </p>
                    <p>
                        <label for="content">Content</label>
                        <textarea name="content" id="content"></textarea>
                    </p>
                    <p>
                        <input type="submit" name="command" value="Submit">
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