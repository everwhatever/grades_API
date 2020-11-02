<?php


namespace App\Service;


use App\Entity\Grade;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DisplayGrades
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return array
     */
    public function displayGrades(Request $request, EntityManagerInterface $entityManager): array
    {
        $data = json_decode($request->getContent(), true);
        $filter = $data['filter'];
        $repository = $entityManager->getRepository(Grade::class);

        return $this->filterGrades($filter, $repository);
    }

    /**
     * @param $filter
     * @param $repository
     * @return array
     */
    private function filterGrades($filter, $repository): array
    {
        if ($filter == null) {

            return $repository->findBy([], ['grade' => 'DESC']);
        }

        return $repository->findBy(['grade' => $filter]);
    }
}