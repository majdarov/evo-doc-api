<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $arr_cat = [];
        $members = [];
        foreach ($categories as $category) {
            $barcodes = [];
            foreach ($category->getBarcodes() as $bc) {
                $barcodes[] = $bc->getBarcode();
            }
            $arr_cat[] = [
                'name' => $category->getName(),
                'code' => $category->getCode(),
                'barcodes' => $barcodes,
                'members' => $productRepository->getArrayProductByParent($category),
            ];
            $members[] = $category->getMembers();
        }

        // return new JsonResponse($arr_cat);
        return $this->render('category/index.html.twig', [
            'categories' => $arr_cat,
            'controller_name' => 'CategoryController',
            'members' => $members,
        ]);
    }
}
