<?php


namespace App\Controller;


use App\Service\AddGrade;
use App\Service\DisplayGrades;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GradesController extends AbstractController
{


    private $entityManager;
    private $addGrade;
    private $displayGrades;

    public function __construct(EntityManagerInterface $entityManager, AddGrade $addGrade, DisplayGrades $displayGrades)
    {

        $this->entityManager = $entityManager;
        $this->addGrade = $addGrade;
        $this->displayGrades = $displayGrades;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/grades", methods={"POST"})
     */
    public function addGradeAction(Request $request)
    {
        $grade = $this->addGrade->addGrade($request);

        $this->entityManager->persist($grade);
        $this->entityManager->flush();

        return $this->json($grade);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/grades", methods={"GET"})
     */
    public function displayGradesAction(Request $request)
    {
        $grades = $this->displayGrades->displayGrades($request, $this->entityManager);

        return $this->json($grades);
    }

}