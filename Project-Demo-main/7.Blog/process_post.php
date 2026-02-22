<?php

/*******w******** 
    
    Name:Dingguo Du
    Date:2023/1/23
    Description:Blog

****************/

require('connect.php');
require('authenticate.php');

// Process POST from creat.php when submit button was triggered.
if ($_POST && !empty(trim($_POST['title'])) && !empty(trim($_POST['content'])) &&($_POST['command']=="Submit")) 
{
    //  Sanitize user input to escape HTML entities and filter out dangerous characters.
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //  Build the parameterized SQL query and bind to the above sanitized values.
    $query = "INSERT INTO blog (title,content) VALUES (:title,:content)";
    $statement = $db->prepare($query);
    
    //  Bind values to the parameters
    $statement->bindValue(":title",$title);
    $statement->bindValue(":content",$content);

    
    //  Execute the INSERT.
    //  execute() will check for possible SQL injection and remove if necessary
    if($statement->execute())
    {
       header("Location: index.php");
       exit;
    }
} // Process POST from edit.php when update button was triggered.
else if($_POST && !empty(trim($_POST['title'])) && !empty(trim($_POST['content'])) &&($_POST['command']=="Update"))
{
    // If the posted id is not integer,the edit will redirect to index page. 
    if(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT))
    {
        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "UPDATE blog SET title = :title, content = :content WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);        
        $statement->bindValue(':content', $content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
    
        //  Execute the INSERT.
        //  execute() will check for possible SQL injection and remove if necessary
        if($statement->execute())
        {
            header("Location: index.php");
            exit;
        }
    }
    else
    {
        header("Location: index.php");
        exit;
    }
}// Process POST from edit.php when delete button was triggered.
else if($_POST && ($_POST['command']=="Delete"))
{  
    // If the posted id is not integer,the edit will redirect to index page. 
    if(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT))
    {
        // Sanitize user input to escape HTML entities and filter out dangerous characters.
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "DELETE FROM blog WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        //  Execute the INSERT.
        //  execute() will check for possible SQL injection and remove if necessary
        if($statement->execute())
        {
        header("Location: index.php");
        exit;
        }
    }
    else
    {
        header("Location: index.php");
        exit;
    }
}// If the posted title or content is empty submitted from create page, the page will redirect to erroPage.html 
else
{   
    header("Location: errorPage.html");
}


?>