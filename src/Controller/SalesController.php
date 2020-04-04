<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function fixListAction()
    {
        $content = file_get_contents('potato_sales.json');
        $sales = json_decode($content, true);

        return $this->render('sales_fixed_loading.html.twig',[
            'columns' => $sales['column'],
            'products' => $sales['data']
        ]);
    }

    /**
     * @Route("/list/dynamic", name="sales.list.dynamic")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function AjaxlistAction()
    {
        return $this->render('sales.html.twig');
    }
}
