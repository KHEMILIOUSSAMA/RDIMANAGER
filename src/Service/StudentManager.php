<?php

namespace App\Service;

use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;

class StudentManager
{
    private $rep;
    private $manager;

    function __construct(StudentRepository $rep, EntityManagerInterface $manager)
    {
        $this->rep = $rep;
        $this->manager = $manager;
    }

    public function getStudent()
    {
        return  $this->rep->findAll();
    }

    public function crudStudent($student)
    {
        $this->manager->persist($student);
        $this->manager->flush();
    }


    public function deleteStudent($student)
    {
        $this->manager->remove($student);
        $this->manager->flush();
    }
}
