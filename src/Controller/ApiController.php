<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api")
 *
 * Class ApiController
 * @package App\Controller
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/sales", name="api.sales.get", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function salesAction()
    {
        $content = file_get_contents('potato_sales.json');
        return JsonResponse::fromJsonString($content);
    }
}
