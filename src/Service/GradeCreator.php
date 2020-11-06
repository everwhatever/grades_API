<?php


namespace App\Service;


use App\Entity\Grade;
use App\Form\Type\AddGradeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class GradeCreator
{

    private FormFactoryInterface $formFactory;
    private EntityManagerInterface $entityManager;

    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {

        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    public function addGrade($request): Grade
    {
        $grade = new Grade();

        $form = $this->formFactory->create(AddGradeType::class, $grade);
        $this->processForm($request, $form);


        $this->entityManager->persist($grade);
        $this->entityManager->flush();

        return $grade;
    }

    private function processForm($request, $form): void
    {
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
    }
}




