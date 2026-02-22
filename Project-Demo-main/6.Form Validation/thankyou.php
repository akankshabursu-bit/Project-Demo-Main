<?php

/*******w******** 
    
    Name: Dingguo Du
    Date: 2023/1/13
    Description: Server-Side User Input Validation

****************/
if(isset($_POST['fullname']))
{
    $name = $_POST['fullname'];
}

$errorMessage=array();

function formHasError()
{
    $errorFlag = false;
    global $errorMessage;

    //Validate email address
    if(!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))
    {
        $errorFlag=true;
        $errorMessage[]="Invalid email address.";
    }
    
    //Validate postal code
    $reg=array("options"=>array("regexp"=>"/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/"));
    if(!filter_input(INPUT_POST, 'postal', FILTER_VALIDATE_REGEXP, $reg))
    {
        $errorFlag=true;
        $errorMessage[]="Invalid postal code.";
    }
    

    //Validate credit card number
    $int_CardNumber = ["options" => ["min_range" => 1000000000 , "max_range"=> 9999999999]];
    if(!filter_input(INPUT_POST, 'cardnumber', FILTER_VALIDATE_INT,$int_CardNumber))
    {
        $errorFlag=true;
        $errorMessage[]="Invalid card number.";
    }
    
    //Validate credit card month
    $int_Month = ["options" => ["min_range" => 1 , "max_range"=> 12]];
    if(!filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT,$int_Month))
    {
        $errorFlag=true;
        $errorMessage[]="Invalid month input.";
    }
   

    //Validate credit card year
    $currentDate = (int)date("Y");
    $maxDate = $currentDate + 5;
    $int_Year=["options" => ["min_range" => $currentDate , "max_range"=> $maxDate]];
    if(!filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT,$int_Year))
    {
        $errorFlag=true;
        $errorMessage[]="Invalid year input.";
    }
    

    //validate credit card type
    if(filter_input(INPUT_POST,'cardtype'))
    {
        $cardType=0;
        switch($_POST['cardtype'])
        {
            case"visa":
                $cardType=1;
                break;
            case"amex":
                $cardType=2;
                break;
            case"mastercard":
                $cardType=3;
                break;
            default:
                $cardType=4;
        }

        if($cardType==4)
        {
            $errorFlag=true;
            $errorMessage[]="Invalid credit card type.";
        }
    }
    else
    {
        $errorFlag=true;
        $errorMessage[]="Credit card type cannot be blank.";
    } 
    
    //Validate full name must not be blank
    if(!filter_input(INPUT_POST,'fullname'))
    {
        $errorFlag=true;
        $errorMessage[]="Full name cannot be blank.";
    }
    

    //Validate card holder name must not be blank
    if(!filter_input(INPUT_POST,'cardname'))
    {
        $errorFlag=true;
        $errorMessage[]="Card holder name cannot be blank.";
    }

    //Validate address must not be blank
    if(!filter_input(INPUT_POST,'address'))
    {
        $errorFlag=true;
        $errorMessage[]="Address cannot be blank.";
    }
    

    //Validate city must not be blank
    if(!filter_input(INPUT_POST,'city'))
    {
        $errorFlag=true;
        $errorMessage[]="City cannot be blank.";
    }
    

    //The province must be one of the two digit abbreviations selected.
    if(filter_input(INPUT_POST,'province'))
    {
        $provinceCode=0;
        switch($_POST['province'])
        {
            case"AB":
                $provinceCode=1;
                break;
            case"BC":
                $provinceCode=2;
                break;
            case"MB":
                $provinceCode=3;
                break;
            case"NB":
                $provinceCode=4;
                break;
            case"NL":
                $provinceCode=5;
                break;
            case"NS":
                $provinceCode=6;
                break;
            case"ON":
                $provinceCode=7;
                break;
            case"PE":
                $provinceCode=8;
                break;
            case"QC":
                $provinceCode=9;
                break;
            case"SK":
                $provinceCode=10;
                break;
            case"NT":
                $provinceCode=11;
                break;
            case"NU":
                $provinceCode=12;
                break;
            case"YT":
                $provinceCode=13;
                break;
            default:
                $provinceCode=14;
        }
    
        if($provinceCode==14)
        {
            $errorFlag=true;
            $errorMessage[]="Invalid province code.";
        }  
    }
    else
    {
        $errorFlag=true;
        $errorMessage[]="Province code cannot be blank.";
    }
    

    //All quantities must be integers or blank.
   
     
     $result1=($_POST['qty1']!=null)&&($_POST['qty1']!=0)&&!filter_input(INPUT_POST,'qty1', FILTER_VALIDATE_INT); 
     $result2=($_POST['qty2']!=null)&&($_POST['qty2']!=0)&&!filter_input(INPUT_POST,'qty2', FILTER_VALIDATE_INT);
     $result3=($_POST['qty3']!=null)&&($_POST['qty3']!=0)&&!filter_input(INPUT_POST,'qty3', FILTER_VALIDATE_INT);
     $result4=($_POST['qty4']!=null)&&($_POST['qty4']!=0)&&!filter_input(INPUT_POST,'qty4', FILTER_VALIDATE_INT);
     $result5=($_POST['qty5']!=null)&&($_POST['qty5']!=0)&&!filter_input(INPUT_POST,'qty5', FILTER_VALIDATE_INT);
        
    if($result1||$result2||$result3||$result4||$result5)
    {
        $errorFlag=true;
        $errorMessage[]="Invalid item quantity.";
    }           

    

    return $errorFlag;
    
}

$items = [
    ['Description' => 'iMac',        'Cost' => 1899.99, 'Quantity' => $_POST['qty1']],
    ['Description' => 'Razer Mouse', 'Cost' => 79.99,   'Quantity' => $_POST['qty2']],
    ['Description' => 'WD HDD',      'Cost' => 179.99,  'Quantity' => $_POST['qty3']],
    ['Description' => 'Nexus',       'Cost' => 249.99,  'Quantity' => $_POST['qty4']],
    ['Description' => 'Drums',       'Cost' => 119.99,  'Quantity' => $_POST['qty5']]
];

$totalCost=0;
foreach($items as $item)
{
    $totalCost += $item['Cost']*(float)$item['Quantity'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Thanks for your order!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div class="invoice">
        <?php if(!formHasError()): ?>
            <h2>Thanks for your order <?=$name?>.</h2> 
            <h3>Here's a summary of your order:</h3> 
            <table>
                <tr>
                    <td colspan="4"><h3>Address Information</h3></td>
                </tr>
                <tr>
                    <td class="alignright"><span class="bold">Address:</span></td>
                    <td><?=$_POST['address']?></td>
                    <td class="alignright"><span class="bold">City:</span></td>
                    <td><?=$_POST['city']?></td>
                </tr>
                <tr>
                    <td class="alignright"><span class="bold">Province:</span></td>
                    <td><?=$_POST['province']?></td>
                    <td class="alignright"><span class="bold">Postal Code:</span></td>
                    <td><?=$_POST['postal']?></td>
                </tr>
                <tr>
                    <td colspan="2" class="alignright"><span class="bold">Email:</span></td>
                    <td colspan="2"><?=$_POST['email']?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td colspan="3"><h3>Order Information</h3></td>
                </tr>
                <tr>
                    <td><span class="bold">Quantity</span></td>
                    <td><span class="bold">Description</span></td>
                    <td><span class="bold">Cost</span></td>
                </tr>

                <?php foreach($items as $item): ?>
                    <?php if($item['Quantity']>0): ?>
                        <?php $quantity=(float)$item['Quantity']?>
                        <tr><td><?=$item['Quantity']?></td><td><?=$item['Description']?></td><td class='alignright'><?=$quantity*$item['Cost']?></td></tr>
                    <?php endif?>
                <?php endforeach?>

                <tr>
                    <td colspan="2" class='alignright'><span class="bold">Totals</span></td>
                    <td class='alignright'><span class="bold">$ <?=$totalCost?></span></td>
                </tr>
            </table>
        <?php else: ?>
            
            <h2>Something wrong has happened!</h2>
            <ul>
                <?php foreach($errorMessage as $message):?>
                <li><?=$message?></li>
                <?php endforeach?>
            </ul>
        <?php endif ?>
    </div>
    
        <?php if(!formHasError()&&($totalCost > 10000)):?>
            <div id="rollingrick">
                <h2>Congrats on the big order. Rick Astley congratulates you.</h2>
                <iframe width="600" height="475" src="//www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
            </div>
        <?php endif?>
    
    
</body>
</html>