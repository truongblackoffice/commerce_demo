<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Order.php';

class UserController extends Controller
{
    public function __construct()
    {
        Session::start();
    }

    public function login()
    {
        if (Auth::check()) {
            Helpers::redirect('product/index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $user = $userModel->findByUsername($_POST['username']);
            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                Auth::login($user);
                Helpers::redirect('product/index');
            }
            $error = 'Sai tên đăng nhập hoặc mật khẩu';
            $this->view('user/login', ['error' => $error]);
            return;
        }

        $this->view('user/login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $existing = $userModel->findByUsername($_POST['username']);
            if ($existing) {
                $this->view('user/register', ['error' => 'Tên đăng nhập đã tồn tại']);
                return;
            }

            $userModel->create([
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'full_name' => $_POST['full_name'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
            ]);
            Helpers::redirect('user/login');
            return;
        }

        $this->view('user/register');
    }

    public function profile()
    {
        if (!Auth::check()) {
            Helpers::redirect('user/login');
        }

        $user = Auth::user();
        $orderModel = new Order();
        $orders = $orderModel->getByUser($user['id']);
        $this->view('user/profile', ['user' => $user, 'orders' => $orders]);
    }

    public function logout()
    {
        Auth::logout();
        Helpers::redirect('product/index');
    }
}
