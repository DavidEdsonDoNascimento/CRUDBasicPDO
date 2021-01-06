<?php

require_once '../../vendor/autoload.php';

use Alura\Pdo\DAO\Connection;
use Alura\Pdo\DAO\StudentDAO;


$id = isset($_POST['id'])? $_POST['id'] : null;
$name = isset($_POST['name'])? $_POST['name'] : null;
$birth_date = isset($_POST['birth_date'])? $_POST['birth_date'] : null;

$pdo = Connection::getConnection();
$sql = "UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);
$result = $statement->execute();

if($result)
    header("Location: ../../students.php?msg=SUCC_UPDATE");
else
    header("Location: ../../update-student.php?id=$id&error=ER_UPDATE");