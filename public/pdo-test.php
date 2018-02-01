<?php

echo "<h1>Test PDO 1</h1>";

try {
    $db = new PDO('mysql:host=localhost;dbname=sf4_training;charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $createaTableQuery = '
      CREATE TABLE IF NOT EXISTS user (
        id int(11) NOT NULL auto_increment,
        email varchar(100) NOT NULL,
        password varchar(255) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY email (email)
      );
    ';
    $db->exec($createaTableQuery);
} catch (PDOException $e) {
    echo $e->getMessage();
}


try {
    //INSERT A VALUE
    $db->exec("INSERT INTO user (email, password) VALUES ('".getFakeEmail()."','".rand(1,100)."')");

    //INSERT WITH PLACEHOLDER
    $stmt = $db->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
    $stmt->execute(array(
        getFakeEmail(),
        rand(1,100))
    );

    //INSERT WITH BIND
    $stmt = $db->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
    $stmt->bindParam(':email', getFakeEmail(), PDO::PARAM_STR);
    $stmt->bindParam(':password', rand(1,100), PDO::PARAM_STR);
    $stmt->execute();

    //SELECT ALL
    $stmt = $db->query('SELECT * FROM user');
    $rows = $stmt->fetchAll();

    foreach ($rows as $row) {
        echo $row['id'] . ' - ';
        echo $row['email'] . ' - ';
        echo $row['password'] . '<br><br>';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}


function getFakeEmail(): string
{
    return 'user' . rand(1, 1000) . '@email.com';
}