<!-- PATRICK AVIEL PERALTA -->
<?php
    session_start();
    require('new-connection.php');
    include('functions.php');

    $query = "SELECT messages.id,messages.message,messages.created_at,users.first_name,users.last_name,messages.user_id FROM messages INNER JOIN users ON messages.user_id = users.id";
    $results = fetch_all($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="success.css">
</head>
<body>
<div class="main-container">
    <header>
        <h3>CodingDojo Wall</h3>
        <h3>👋Welcome,  
<?php
            if(isset($_SESSION['first_name'])){
                echo "{$_SESSION['first_name']}!";
            }
?>
            <a href="process.php">Log Out</a>
        </h3>
    </header>

        <form action="post-process.php" method="post">
            <input type="hidden" name="action" value="post_message">
            <textarea name="post" rows="5"></textarea>
            <input type="submit" value="Post a message">
        </form>
<?php
        foreach($results as $row){
            $date=date_create($row['created_at']);
            $message_id=$row['id'];
            $user_id=$row['user_id'];
?>          
            <div class="post">
                <h3><?= $row['first_name'] ?> <?= $row['last_name'] ?> - <?= date_format($date,"F d, Y") ?></h3>
                <p><?= $row['message'] ?></p> 
<?php    
                    if( $user_id==$_SESSION['user_id']){
                        echo "<a href='delete_record.php?message_id=$message_id' class='delete'>Delete Post</a>";
                    }         
?> 
                <div class="comments">
<?php    
                    query_all_posts($message_id);         
?>          
                    <form action="post-process.php" method="post" class="comment">
                        <input type="hidden" name="post_id" value="<?=$message_id?>">
                        <input type="hidden" name="action" value="comment">
                        <p>Write a comment:</p>
                        <textarea name="comment" rows="3"></textarea>
                        <input type="submit" value="Write a comment">
                    </form>

                </div>
            </div>
<?php       }
            if(isset($_SESSION['message_comment'])){
                echo $_SESSION['message_comment'];
            }
            unset($_SESSION['message_comment']);
?>
    </div>
</body>
</html>