<?php

require_once '../../vendor/autoload.php';

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\DAO\StudentDAO;
use Alura\Pdo\DAO\Connection;
use DateTime;


$name = $_POST['name'];
$birth_date = DateTime::createFromFormat('d/m/Y', $_POST['birth_date']);
$birth_date_format = $birth_date->format('Y/m/d');
$pdo = Connection::getConnection();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO students(name, birth_date) values (:name, :birth_date)";
$statement = $pdo->prepare($sql);
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':birth_date', $birth_date_format, PDO::PARAM_STR);
$result = $statement->execute();

if($result)
    header("Location:../../students.php");
else
    header("Location:../../insert-student.php?error=ER_IS");