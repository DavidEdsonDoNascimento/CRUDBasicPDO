<?php

require_once '../../vendor/autoload.php';

use Alura\Pdo\DAO\Connection;
use Alura\Pdo\DAO\StudentDAO;

$id = isset($_GET['id'])? $_GET['id'] : null;

if(empty($id))
    echo json_encode(array("student" => null));

$pdo = Connection::getConnection();
$sql = "SELECT * FROM students WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$student = $statement->fetch(PDO::FETCH_ASSOC);

echo json_encode(array("student" => $student));