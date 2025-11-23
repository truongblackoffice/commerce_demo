<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Order.php';

class CartController extends Controller
{
    public function __construct()
    {
        Session::start();
    }

    public function index()
    {
        $cart = Session::get('cart', []);
        $this->view('cart/index', ['cart' => $cart]);
    }

    public function add($id)
    {
        $productModel = new Product();
        $product = $productModel->find($id);
        if (!$product) {
            Helpers::redirect('product/index');
        }

        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1,
            ];
        }
        Session::set('cart', $cart);
        Helpers::redirect('cart/index');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cart = Session::get('cart', []);
            foreach ($_POST['quantities'] as $id => $quantity) {
                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] = max(1, (int)$quantity);
                }
            }
            Session::set('cart', $cart);
        }
        Helpers::redirect('cart/index');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::set('cart', $cart);
        Helpers::redirect('cart/index');
    }

    public function checkout()
    {
        if (!Auth::check()) {
            Helpers::redirect('user/login');
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            Helpers::redirect('cart/index');
        }

        $this->view('cart/checkout', ['cart' => $cart, 'user' => Auth::user()]);
    }

    public function placeOrder()
    {
        if (!Auth::check()) {
            Helpers::redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cart = Session::get('cart', []);
            if (empty($cart)) {
                Helpers::redirect('cart/index');
            }

            $orderModel = new Order();
            $user = Auth::user();
            $orderId = $orderModel->createOrder($user['id'], [
                'full_name' => $_POST['full_name'] ?? $user['full_name'],
                'phone' => $_POST['phone'] ?? $user['phone'],
                'address' => $_POST['address'] ?? $user['address'],
            ], $cart);

            Session::remove('cart');
            $this->view('cart/confirmation', ['orderId' => $orderId]);
            return;
        }

        Helpers::redirect('cart/index');
    }
}
