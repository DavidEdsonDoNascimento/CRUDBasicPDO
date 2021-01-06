<?php

namespace Alura\Pdo\DAO;
use PDO;
use Alura\Pdo\DAO\Connection;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\ViewModel\StudentViewModel;

final class StudentDAO
{
    private $connection = null;

    public function __construct()
    {
        //$this->connection = Connection::getConnection();
    }

    public function insert($connection, Student $student)
    {
        $sql = "INSERT INTO students (`name`, `birth_date`) values ('{$student->name()}', '{$student->birthDate()->format('Y-m-d')}')";
        return $connection->exec($sql);
    }

    public function list() : array
    {
        $statement = $this->connection->prepare("SELECT * FROM students");
        $statement->execute();
        Connection::closeConnection();

        $list = [];

        while ($r = $statement->fetch(PDO::FETCH_ASSOC)){
            $std = new StudentViewModel($r['id'], $r['name'], $r['birth_date']);
            array_push($list, $std);
        }
        return $list;
        // $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        // $students = array_map(function($element){
        //     return new StudentViewModel($element['id'], $element['name'], $element['birth_date']);
        // }, $result);
        
        // return $students;
    }

    public function searchById(int $id)
    {
        $statement = $this->connection->query("SELECT * FROM students WHERE id = $id");

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
}