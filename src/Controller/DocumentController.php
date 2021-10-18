<?php

namespace App\Controller;

use App\Entity\{Contragent, DocProd, Document, Product};
use App\Helper\DocumentHelper;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DocumentController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/document', name: 'document')]
    public function index(Request $request): Response
    {

        $docs = $this->getDoctrine()->getRepository(Document::class)->findAll();

        $name = 'Documents';

        $arr_docs = [];
        foreach($docs as $doc) {
            $arr_docs[] = [
                'doc_num' => $doc->getDocNum(),
                'date' => $doc->getDocDate()->format(DateTimeImmutable::RSS),
                'seller' => $doc->getCntSeller()->getCntName(),
                'receiver' => $doc->getCntReceiver()->getCntName(),
            ];
        }

        // return new JsonResponse($arr_cnts);

        return new Response($this->twig->render('document/index.html.twig', [
            'docs' => $docs,
            'name' => $name,
            'controller_name' => 'DocumentController',
            'json' => json_encode($arr_docs),
            'format_date' => 'd.m.Y',
        ]));

    }
}
