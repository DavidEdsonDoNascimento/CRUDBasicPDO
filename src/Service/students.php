<?php

require_once '../../vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\DAO\StudentDAO;
use Alura\Pdo\DAO\Connection;


$sql = "SELECT * FROM students";
$pdo = Connection::getConnection();
$statement = $pdo->prepare($sql);
$statement->execute();
$students = $statement->fetchAll();

echo json_encode(array("students" => $students));