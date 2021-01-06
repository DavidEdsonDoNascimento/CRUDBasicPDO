<?php
namespace Alura\Pdo\Domain\ViewModel;

class StudentViewModel
{
    public ?int $id;
    public string $name;
    public string $birth_date;


    public function __construct(?int $id, string $name, string $birth_date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birth_date = $birth_date;
    }
}