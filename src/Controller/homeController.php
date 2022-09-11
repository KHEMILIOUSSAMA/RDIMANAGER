<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Service\StudentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class homeController extends AbstractController
{

    /**
     * @Route("student/show", name="liste")
     */

    public function show(StudentManager $studentManager): Response
    {

        $students = $studentManager->getStudent();
        return $this->render('show.html.twig', [
            'students' => $students
        ]);
    }

    /**
     * @Route ("student/create",name="student_new")
     */
    public function create(Request $request, StudentManager $studentManager)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $studentManager->crudStudent($student);
            return $this->redirectToRoute('liste');
        }

        return $this->render('create.html.twig', [
            'formEtudiant' => $form->createView()

        ]);
    }

    /**
     * @Route("student/{id}/edit", name="student_edit")
     */
    public function editStudent(Student $student, Request $request, StudentManager $studentManager): Response
    {

        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $studentManager->crudStudent($student);
            return $this->redirectToRoute('liste');
        }
        return $this->render("edit.html.twig", [
            "formEtudiant" => $form->createView()
        ]);
    }

    /**
     * @Route("student/{id}/delete", name="student_delete")
     */
    public function delete(Student $student, StudentManager $studentManager)
    {
        $studentManager->deleteStudent($student);
        return $this->redirectToRoute("liste");
    }
}
