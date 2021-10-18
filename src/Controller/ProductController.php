<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(ValidatorInterface $validator): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $arr_products = [];
        foreach ($products as $product) {
            $barcodes = [];
            foreach($product->getBarcodes() as $barcode) {
                $barcodes[] = $barcode->getBarcode();
            }
            $parent = $product->getParent() ? $product->getParent()->getName() : \null;
            $arr_products[] = [
                'name' => $product->getName(),
                'parent' => $parent,
                'barcodes' => $barcodes,
            ];
        }
        return new JsonResponse($arr_products);
        // return $this->render('product/index.html.twig', [
        //     'controller_name' => 'ProductController',
        //     'json_string' => \json_encode($arr_products),
        //     'products' => $products,
        //     'arr_products' => $arr_products,
        // ]);
    }
}
