<?php


namespace App\Controller;


use App\Service\GradeCreator;
use App\Service\GradesFeature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GradesController extends AbstractController
{

    private GradeCreator $gradeCreator;
    private GradesFeature $gradesFeature;

    public function __construct(GradeCreator $gradeCreator, GradesFeature $gradesFeature)
    {
        $this->gradeCreator = $gradeCreator;
        $this->gradesFeature = $gradesFeature;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/grades", methods={"POST"})
     */
    public function addGradeAction(Request $request): JsonResponse
    {
        $grade = $this->gradeCreator->addGrade($request);

        return $this->json($grade);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/grades", methods={"GET"})
     */
    public function displayGradesAction(Request $request): JsonResponse
    {
        $grades = $this->gradesFeature->displayGrades($request);

        return $this->json($grades);
    }

}
