<html>
<head>
    <style>
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ccc;
            padding: 5px;
        }

        table th {
            background: #eee;
        }
    </style>
</head>
<body><h1>Библиотека успешного человека</h1>

<!--<form method="GET">
    <input name="isbn" placeholder="ISBN" value="" type="text">
    <input name="name" placeholder="Название книги" value="" type="text">
    <input name="author" placeholder="Автор книги" value="" type="text">
    <input value="Поиск" type="submit">
</form> -->
<form method="GET">
    <input name="isbn" placeholder="ISBN" value="" type="text">
    <input value="Поиск" type="submit">
</form>
<form method="GET">
    <input name="author" placeholder="Автор книги" value="" type="text">
    <input value="Поиск" type="submit">
</form>
<form method="GET">
    <input name="name" placeholder="Название книги" value="" type="text">
    <input value="Поиск" type="submit">
</form>

<table>
    <tbody>
    <tr>
        <th>Название</th>
        <th>Автор</th>
        <th>Год выпуска</th>
        <th>Жанр</th>
        <th>ISBN</th>
    </tr>
    <?php
    $host = 'localhost';    //127.0.0.1
    $db = 'Books';
    $user = 'root';
    $password = null;
    $charset = 'utf8';

//    $mysqli = new mysqli($host, $user, $password, $db);
//    if ($mysqli) {
//        //echo "Подключение успешно!<br>";
//    } else {
//        echo "Ошибка! Соединения нет!";
//        echo $mysqli->connect_error();
//        exit();
//    }
//    $charset = 'utf8';
//    $mysqli->set_charset($charset);

    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
    //var_dump($pdo);exit();

    function showBooks($statement){
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td> <?= $row['name'] ?></td>
        <td> <?= $row['author'] ?></td>
        <td> <?= $row['year'] ?></td>
        <td> <?= $row['genre'] ?></td>
        <td> <?= $row['isbn'] ?></td>
    </tr>
<?php }
}
if (isset($_GET['isbn']) or isset($_GET['author']) or isset($_GET['name'])) {
    foreach ($_GET as $k => $v) {
        $sql = "SELECT * FROM `books` WHERE `$k` LIKE '%" . $v . "%' ";
        $statement = $pdo -> prepare($sql);
        $statement -> execute();
        showBooks($statement);
    }
} else {
    $sql = "SELECT * FROM `books` ";
    $statement = $pdo -> prepare($sql);
    $statement -> execute();
    showBooks($statement);
}
?>