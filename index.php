<?php
    include_once("./models/Database.php");
    include_once("./models/Actor.php");
    include_once("./controllers/ActorController.php");

    $actors = array();

    $db = new Database();


    if(isset($_POST['Submit'])){
        ActorController::add();
    }
    if(isset($_REQUEST['remove'])) {
        ActorController::remove();
    }
    if(isset($_POST['update'])) {
        ActorController::update();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <form action="" method="post">
        <input type="text" name="name"/>
        <input type="text" name="surname"/>
        <input type="text" name="age"/>
        <input type="submit" name="Submit"/>
    </form>
    
    <table class="table">
        <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Age</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody> 
            <?php 
                $actors = ActorController::get();
                foreach($actors as $actor) {
            ?>
            <tr>
                <form action="" method="post">
                    <td><?php echo 
                        "<input type='text' name='name' value='" . $actor->name . "'/>"; ?>
                    </td>
                    <td><?php echo 
                        "<input type='text' name='surname' value='" . $actor->surname . "'/>"; ?>
                    </td>
                    <td><?php echo 
                        "<input type='text' name='age' value='" . $actor->age . "'/>"; ?>
                    </td>
                    <td>
                            <input type="hidden" name="index" value="<?php echo $actor->id; ?>"/>
                            <input type="submit" name="remove" value="Remove"/>
                            <input type='submit' name='update' value='Update'/>
                    </td>
                </form>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>