<?php

namespace App\Controller;

use App\Entity\Contragent;
use App\Entity\ContragentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentsController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Request $request): Response
    {
        // return $this->render('documents/index.html.twig', [
        //     'controller_name' => 'DocumentsController',
        // ]);
        $cnts = $this->getDoctrine()->getRepository(Contragent::class)->findAll();
        $cnts_li = "<ul>\n";
        foreach($cnts as $cnt) {
            $content = $cnt->getId()." -> ".$cnt->getCntName();
            $cnts_li .= sprintf('<li>%s</li>'."\n", htmlspecialchars($content));
        }
        $cnts_li .= "</ul>\n";

        if ($type = $request->query->get('type')) {
            $name = $this->getDoctrine()->getRepository(ContragentType::class)
                ->findOneBy(['cnt_type' => $type])
                ->getContragents()[0]
                ->getCntName();
        } else {
            $name = 'Contragents';
        }
        $greet = sprintf("<h1>Type %s!</h1>", htmlspecialchars($name));

        return new Response(<<<EOF
        <html>
            <body>
            $greet
            $cnts_li
                <img src="images/under-construction.gif" alt="under construction">
            </body>
        </html>
        EOF);
    }
}
