<?php


namespace App\Service;


use App\Entity\Grade;
use App\Form\Type\AddGradeType;
use Symfony\Component\Form\FormFactoryInterface;

class AddGrade
{

    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {

        $this->formFactory = $formFactory;
    }

    public function addGrade($request)
    {
        $grade = new Grade();

        $form = $this->formFactory->create(AddGradeType::class, $grade);
        $this->proccesForm($request, $form);

        return $grade;
    }

    private function proccesForm($request, $form)
    {
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
    }
}