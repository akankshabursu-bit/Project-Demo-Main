<?php

/*******w******** 
    
    Name: Dingguo Du
    Date: 2023/1/6
    Description: Splash gallery

****************/

$config = [

    'gallery_name' => 'Dingguo Gallery',
 
    'unsplash_categories' => ['River','Sky','Bridge','Mountain','Earth','Dog','Flower','Forest'],
 
    'local_images' => ['images/image_1.jpg'=>['davehoefler','Dave Hoefler'],
                       'images/image_2.jpg'=>['axpphotography','AXP Photography'],
                       'images/image_3.jpg'=>['limamauro23','Mauro Lima'],
                       'images/image_4.jpg'=>['emmeli_m','Emmeli M']
                      ]
 
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <title>Assignment 1</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <h1><?=$config['gallery_name']?></h1>
    <div id="gallery">
        <?php foreach($config['unsplash_categories'] as $category):?>
        <div>
            <h2><?=$category?></h2>
            <img src="https://source.unsplash.com/300x200/?<?=$category?>" alt="<?=$category?>">
        </div>
        <?php endforeach ?>
    </div>

    <h1><?= count($config['local_images']) ?> Large images</h1>
    <div id="large-images">
        <?php foreach($config['local_images'] as $key => $value):?>
        <img src="<?=$key?>" alt="<?=$value[1]?>">
        <h3 class="photographer"><a href="https://unsplash.com/@<?=$value[0]?>"><?=$value[1]?></a></h3>
        <?php endforeach ?>
    </div>

</body>
</html>