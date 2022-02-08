<?php

namespace App\Service\Cart;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ArticleRepository;
use App\Repository\ProductRepository;

class CartService {

    protected $session;
    protected $accessoryRepository;
    protected $productRepository;

    public function __construct(SessionInterface $session, ArticleRepository $accessoryRepository){
        $this->session = $session;
        $this->accessoryRepository = $accessoryRepository;
    }


    public function add(int $id) {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $this->session->set('cart', $cart);

    }

    public function delete(int $id) {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }

        $this->session->set('cart', $cart);
    }

    public function getFullCart(): array
    {
        $cart = $this->session->get('cart', []);
        $cartData = [];
        foreach ($cart as $id => $quantity) {
            $cartData[] = [
                'accessory' => $this->accessoryRepository->find($id),
                'quantity' => $quantity,
            ];
        }
        return $cartData;
    }

    public function getTotal(): float 
    {
        $total = 0;

        foreach ($this->getFullCart() as $item) {
            $total += $item['accessory']->getPrice() * $item['quantity'];
        }
        return $total;

    }

    public function remove(int $id)
    {
        $cart = $this->session->get('cart', []);

        if (!empty($cart[$id] > 1)) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }

        $this->session->set("cart", $cart);

    }

    
}