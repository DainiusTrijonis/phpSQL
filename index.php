<?php
    include_once("Database.php");
    include_once("Actor.php");

    $actors = array();

    $db = new Database();



    if(isset($_POST['Submit'])){
        $actor = new Actor($_POST['id'], $_POST['name'], $_POST['surname'], $_POST['age']);
        $id = $db->Insert(
            "INSERT INTO actors (name, surname, age) VALUES (?, ?, ?)", 
            ["sss",$actor->name, $actor->surname, $actor->age]
        );
        echo "New record created successfully. Last inserted ID is: " . $id;
    }
    if(isset($_REQUEST['remove'])) {
        $unique_id = $_POST['index'];
        if($unique_id!==false) {
            $db->Remove(
                "DELETE FROM actors WHERE id = ?",
                ["i", $unique_id]
            );
        }
    }
    if(isset($_POST['update'])) {
        $unique_id = $_POST["index"];
        if($unique_id!==false) {
            $actor = new Actor($_POST['index'], $_POST['name'], $_POST['surname'], $_POST['age']);
            $db->Update(
                "UPDATE actors SET name = ?, surname = ?, age = ? WHERE id = ?",
                ["sssi", $actor->name, $actor->surname, $actor->age, $actor->id]
            );
        }
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
                $dbResult = $db->Select("SELECT * FROM actors");
                foreach($dbResult as $row) {
                    $actors[] = new Actor($row["id"], $row["name"], $row["surname"], $row["age"]);
                }

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