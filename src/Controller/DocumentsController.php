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

class DocumentsController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    #[Route('/', name: 'homepage')]
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
<<<<<<< HEAD
        return new Response(<<<EOF
<html>
	<body>
	$greet
		<img src="images/under-construction.gif" alt="under construction">
	</body>
</html>
EOF
			);
=======

        // return new JsonResponse($arr_cnts);

        return new Response($this->twig->render('documents/index.html.twig', [
            'cnts' => $cnts,
            'name' => $name,
            'controller_name' => 'DocumentsController',
            'json' => json_encode($arr_cnts),
        ]));

>>>>>>> ffe9e41950d3d7c2ba87ee110de45a31ec6c898a
    }
}
