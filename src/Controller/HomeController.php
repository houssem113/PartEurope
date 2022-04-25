<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Vehicle;
use App\Form\SearchForm;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_vehicle_index', methods: ['GET'])]
    public function index( Request $request,VehicleRepository $vehicleRepository, PaginatorInterface $paginator): Response
    {   
        $query = $vehicleRepository->findSearch($request);
        $pagination = $paginator->paginate(
            $query, 
            $request->query->getInt('page', 1), 
            6 
        );
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $pagination,
            'form' => $form->createView()
        ]);
    }

    #[Route('/vehicle/{id}', name: 'app_vehicle_detail', methods: ['GET'])]
    public function detail(VehicleRepository $vehicleRepository,Vehicle $vehicle): Response
    {   
        $query = $vehicleRepository->findOneBy(['id'=>$vehicle]);
        return $this->render('vehicle/detail.html.twig', [
            'vehicle' => $query,
        ]);
    }
    
}
