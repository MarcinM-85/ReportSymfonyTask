<?php
namespace App\Controller;

use App\Repository\PlaceRepository;
use App\Repository\ReportRepository;
use App\Service\ReportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ReportFilterType;
use App\Form\ReportAddType;

#[Route('/report')]
class ReportController extends AbstractController
{
    #[Route('/', name: 'report_index', methods: ['GET'])]
    public function index(ReportRepository $repo, PlaceRepository $placeRepo): Response
    {
        $reportList = $repo->findByFilters(null, null, null);
        $placeList = $placeRepo->findAll();
        $filterForm = $this->createForm(ReportFilterType::class, null, [
            'action' => $this->generateUrl('report_filter')
        ]);
        
        return $this->render('report/index.html.twig', [
            'filterForm' => $filterForm->createView(),
            'reportList' => $reportList,
            'placeList' => $placeList
        ]);
    }

    #[Route('/filter', name: 'report_filter', methods: ['POST'])]
    public function filter(Request $request, ReportRepository $repo): Response
    {
        $filterForm = $this->createForm(ReportFilterType::class);
        $filterForm->handleRequest($request);
        
        $placeId = $filterForm->get('place')->getData()?->getId() ?: null;
        $startDate = $filterForm->get('startDate')->getData() ? $filterForm->get('startDate')->getData() : null;
        $endDate = $filterForm->get('endDate')->getData() ? $filterForm->get('endDate')->getData() : null;

        $reportList = $repo->findByFilters($placeId, $startDate, $endDate);

        if ($request->isXmlHttpRequest()) {
            return $this->render('report/_list.html.twig', [
                'reportList' => $reportList
            ]);
        }
    }

    #[Route('/add', name: 'report_add', methods: ['GET', 'POST'])]
    public function add(Request $request, ReportService $reportService): Response
    {
        $reportForm = $this->createForm(ReportAddType::class);
        $reportForm->handleRequest($request);

        if ($reportForm->isSubmitted() && $reportForm->isValid()) {
            $name = $reportForm->get('name')->getData();
            $user = $reportForm->get('user')->getData();
            $place = $reportForm->get('place')->getData();
            $date = $reportForm->get('exportDateTime')->getData();

            $report = $reportService->addReport($name, $user, $place, $date);

            $this->addFlash('success', 'Raport dodany');
            
            return $this->redirectToRoute('report_index');
        }

        return $this->render('report/add.html.twig', [
            'reportForm' => $reportForm->createView()
        ]);
    }
}