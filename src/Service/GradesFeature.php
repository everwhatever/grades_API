<?php


namespace App\Service;


use App\Entity\Grade;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class GradesFeature
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){

        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function displayGrades(Request $request): array
    {
        $data = json_decode($request->getContent(), true);
        $filter = $data['filter'];
        $repository = $this->entityManager->getRepository(Grade::class);

        return $this->filterGrades($filter, $repository);
    }

    /**
     * @param $filter
     * @param $repository
     * @return array
     */
    private function filterGrades($filter, $repository): array
    {
        if ($filter === null) {

            return $repository->findBy([], ['grade' => 'DESC']);
        }

        return $repository->findBy(['grade' => $filter]);
    }
}

