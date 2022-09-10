<?php

namespace App\Controller;

use App\Middleware\TokenAuthenticatedControllerInterface;
use App\Repository\PlaceRepository;
use App\Traits\ResponserTrait;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlaceController extends AbstractController implements TokenAuthenticatedControllerInterface
{
    use ResponserTrait;

    #[Route('/places/search', name: 'places.search')]
    public function search(Request $request, PlaceRepository $placeRepository): JsonResponse
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $result = $placeRepository->searchByFilters($startDate, $endDate)
            ->getResult(Query::HYDRATE_ARRAY);

        return $this->successResponse([
            'data' => $result,
        ]);
    }
}
