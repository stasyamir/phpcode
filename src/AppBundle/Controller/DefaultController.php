<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);*/
        $product = new Product();

        $em = $this->getDoctrine()->getEntityManager();

        $productList = $this->getAllProducts($em);

        $productTypeList = $this->getSumByCategory($em);

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class)
            ->add('price', NumberType::class)
            ->add('product_type', EntityType::class, array(
                'class' => ProductType::class,
                'choice_label' => function(ProductType $type) {
                    return $type->getNames();
                }
            ))
            ->add('add_product', SubmitType::class, array('label' => 'Add Product'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect('/', 301);
        }

        $products = "<table><tbody>
            <tr><th>Product title</th><th>Price</th><th>Product type</th></tr>";

        foreach ($productList as $item) {
            $products .= "<tr>";
            $products .= "<td>" . $item['name'] . "</td>";
            $products .= "<td>" . $item['price'] . " UAH</td>";
            $products .= "<td>" . $item['product_type'] . "</td>";
            $products .= "</tr>";
        }

        $products .= "</tbody></table>";

        $typeSum = "<table><tbody>
            <tr><th>Product type</th><th>Sum by product type</th></tr>";

        foreach ($productTypeList as $item) {
            $typeSum .= "<tr>";
            $typeSum .= "<td>" . $item['names'] . "</td>";
            $typeSum .= "<td>" . $item['type_sum'] . " UAH</td>";
            $typeSum .= "</tr>";
        }

        $typeSum .= "</tbody></table>";

        return $this->render('AppBundle::new.html.twig', array(
            'form' => $form->createView(),
            'productList' => $products,
            'typeSum' => $typeSum,
        ));
    }

    private function getAllTypes($em)
    {
        $query = $em->createQuery(
            'SELECT p.names, p.id FROM AppBundle:ProductType p'
        );

        $types = $query->getResult();

        $typesList = array();

        foreach($types as $item) {
            $typesList[$item['id']] = $item['names'];
        }

        return $typesList;
    }

    private function getAllProducts($em)
    {
        $query = $em->createQuery(
            'SELECT p.id, p.name, p.price, IDENTITY(p.productType) AS product_type FROM AppBundle:Product p'
        );
        $products = $query->getResult();

        $typesList = $this->getAllTypes($em);

        $productList = array();

        foreach($products as $product) {
            $product['product_type'] = $typesList[$product['product_type']];
            $productList[] = $product;
        }

        return $productList;
    }

    private function getSumByCategory($em)
    {

        $em = $this->getDoctrine()->getEntityManager();

        $query = $em->createQueryBuilder();

        $query->select('t.names', 'COALESCE(sum(p.price), 0) AS type_sum')
            ->from('AppBundle:ProductType', 't')
            ->leftJoin('AppBundle:Product', 'p')
            ->where('p.productType = t.id')
            ->addGroupBy('t.id');

        $categorySum = $query->getQuery()->getResult();
        //$categorySum = $query->getResult();

        return $categorySum;
    }
}
