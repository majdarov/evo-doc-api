<?php

namespace App\Controller;

use App\Entity\Contragent;
use App\Entity\ContragentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContragentController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/contragent', name: 'contragent')]
    public function index(Request $request): Response
    {

        $cnts = $this->getDoctrine()->getRepository(Contragent::class)->findAll();

        if ($type = $request->query->get('type')) {
            $name = $this->getDoctrine()->getRepository(ContragentType::class)
                ->findOneBy(['cnt_type' => $type])
                ->getContragents()[0]
                ->getCntName();
        } else {
            $name = 'Contragents';
        }

        $arr_cnts = [];
        foreach($cnts as $cnt) {
            $arr_cnts[] = [
                'name' => $cnt->getCntName(),
                'type' => (string) $cnt->getCntType(),
            ];
        }

        // return new JsonResponse($arr_cnts);

        return new Response($this->twig->render('contragent/index.html.twig', [
            'cnts' => $cnts,
            'name' => $name,
            'controller_name' => 'ContragentController',
            'json' => json_encode($arr_cnts),
        ]));

    }
}
