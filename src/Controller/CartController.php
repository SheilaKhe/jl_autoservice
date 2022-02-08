<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Order;
use App\Service\Cart\CartService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartService $cartService)
    {
        $cartData = $cartService->getFullCart();
        $total = $cartService->getTotal();

        return $this->render('cart/index.html.twig', [
            "items" => $cartData,
            "total" => $total
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete")
     */
    public function delete($id, CartService $cartService)
    {
        $cartService->delete($id);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/reservation/{id}", name=")
     */
    public function reservation($id, CartService $cartService)
    {
        $cartData = $cartService->getFullCart();
        $user = $this->getUser();

        $cartItem = new CartItem();
        // $cartItem->setAccessory();

        $order = new Order();
        $order->setUser($user);
        $order->setCartId($id);
        $order->setDate(new \DateTime());
        $order->setStatus('En attente');

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        return $this->render('cart/reservation.html.twig');
    }
}
