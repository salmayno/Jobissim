<?php

namespace App\Controller;

use App\Entity\Emploi;
use App\Entity\Formation;
use Symfony\UX\Chartjs\Model\Chart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatistiquesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/stats", name="stats")
     */
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $formations = $this->entityManager->getRepository(Formation::class)->findAll();
        $emplois = $this->entityManager->getRepository(Emploi::class)->findAll();


        $labelsf = [];
        $dataf = [];
        $labelsf2 = [];
        $dataf2 = [];

        $labelse = [];
        $datae = [];
        $labelse2 = [];
        $datae2 = [];

        // Graphique formation
        foreach ($formations as $formation) {
            $labelsf[] = $formation->getNom();
            $dataf[] = $formation->getClics();
        }

        $chartFormation = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chartFormation->setData([
            'labels' => $labelsf,
            'datasets' => [
                [
                    'label' => 'Clics',
                    'backgroundColor' => '#2277ff',
                    'borderColor' => '#2277ff',
                    'data' => $dataf,
                ],
            ],
        ]);

        foreach ($formations as $formation) {
            $labelsf2[] = $formation->getNom();
            $dataf2[] = $formation->getCandidatures();
        }

        $chartFormation2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chartFormation2->setData([
            'labels' => $labelsf2,
            'datasets' => [
                [
                    'label' => 'Candidatures',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $dataf2,
                ],
            ],
        ]);

        // Graphique emploi
        foreach ($emplois as $emploi) {
            $labelse[] = $emploi->getNom();
            $datae[] = $emploi->getClics();
        }

        $chartEmploi = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chartEmploi->setData([
            'labels' => $labelse,
            'datasets' => [
                [
                    'label' => 'Clics',
                    'backgroundColor' => '#2277ff',
                    'borderColor' => '#2277ff',
                    'data' => $datae,
                ],
            ],
        ]);

        foreach ($emplois as $emploi) {
            $labelse2[] = $emploi->getNom();
            $datae2[] = $emploi->getCandidatures();
        }

        $chartEmploi2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chartEmploi2->setData([
            'labels' => $labelse2,
            'datasets' => [
                [
                    'label' => 'Candidatures',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $datae2,
                ],
            ],
        ]);

        $chartFormation->setOptions([/* ... */]);
        $chartFormation2->setOptions([/* ... */]);
        $chartEmploi->setOptions([/* ... */]);
        $chartEmploi2->setOptions([/* ... */]);
            
        return $this->render('account/statistiques.html.twig', [
            'formations' => $formations,
            'emplois' => $emplois,
            'chartFormation' => $chartFormation,
            'chartFormation2' => $chartFormation2,
            'chartEmploi' => $chartEmploi,
            'chartEmploi2' => $chartEmploi2
        ]);
    }
}
