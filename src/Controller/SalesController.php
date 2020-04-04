<?php

namespace App\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @Route("/sales")
 *
 * Class SalesController
 * @package App\Controller
 */
class SalesController extends AbstractController
{
    /**
     * @Route("/list", name="sales.list")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function listAction()
    {
        $content = file_get_contents('potato_sales.json');
        $sales = json_decode($content, true);
//        dump($sales);

        return $this->render('sales.html.twig',[
            'columns' => $sales['column'],
            'products' => $sales['data']
        ]);
    }

    /**
     * @Route("/fetch", name="sales.fetch", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function fetchAction()
    {
        $content = file_get_contents('potato_sales.json');
        return JsonResponse::fromJsonString($content);
    }
}
