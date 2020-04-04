<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProductType;

/**
 * @Route("/product")
 *
 * Class HomeController
 * @package App\Controller
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/add", name="product.add")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);

       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {

           $this->addFlash('success', 'Product Created!');
       }

        return $this->render('product_add.html.twig', [
            'product_form' => $form->createView(),
        ]);
    }

}
