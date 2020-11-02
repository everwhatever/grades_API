<?php


namespace App\Service;


use App\Entity\Grade;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DisplayGrades
{
    public function displayGrades(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
        $filter = $data['filter'];
        $repository = $entityManager->getRepository(Grade::class);

        return $this->filterGrades($filter, $repository);
    }

    private function filterGrades($filter, $repository)
    {
        if ($filter == null) {

            return $repository->findBy([], ['grade' => 'DESC']);
        }

        return $repository->findBy(['grade' => $filter]);
    }
}