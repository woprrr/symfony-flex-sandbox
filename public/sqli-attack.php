<h1>SQLI ATTACK</h1>

<form action="" method="post">
    Search user by id ...<input type="text" name="id" placeholder=" try '1' OR '1' = '1'" /><br/>
    <input type="submit" value="submit"/>
</form>


<?php


if ($_POST) {
    $id = $_POST['id'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=sf4_training;charset=utf8','root','root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// BAD BAD BAD !!!
//        $sql = "SELECT * FROM user WHERE id=$id";
//
//        foreach ($db->query($sql) as $row) {
//            echo '<br/>UID: ' . $row['id'] . ' Email: ' . $row['email'];
//        }

        $stmt = $db->prepare("SELECT * FROM user WHERE id = ?");
        if ($stmt->execute([$_GET['id']])) {
            while ($row = $stmt->fetch()) {
                echo '<br/>UID: ' . $row['id'] . ' Email: ' . $row['email'];
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
