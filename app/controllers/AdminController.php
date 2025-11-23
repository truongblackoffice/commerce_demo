<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helpers.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderItem.php';
require_once __DIR__ . '/../models/User.php';

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Auth::checkAdmin()) {
            Helpers::redirect('user/login');
        }
    }

    public function index()
    {
        $productModel = new Product();
        $orderModel = new Order();
        $userModel = new User();

        $this->view('admin/dashboard', [
            'productCount' => $productModel->countAll(),
            'orderCount' => $orderModel->countAll(),
            'userCount' => $userModel->countAll(),
            'recentOrders' => $orderModel->getRecent(5),
        ], 'layouts/admin_header.php');
    }

    public function products()
    {
        $productModel = new Product();
        $products = $productModel->getAll();
        $this->view('admin/products_list', ['products' => $products], 'layouts/admin_header.php');
    }

    public function productForm($id = null)
    {
        $productModel = new Product();
        $categoryModel = new Category();
        $product = $id ? $productModel->find($id) : null;
        $this->view('admin/product_form', [
            'product' => $product,
            'categories' => $categoryModel->getAll(),
        ], 'layouts/admin_header.php');
    }

    public function store()
    {
        $productModel = new Product();
        $data = $this->sanitizeProductData($_POST);
        $productModel->create($data);
        Helpers::redirect('admin/products');
    }

    public function update($id)
    {
        $productModel = new Product();
        $data = $this->sanitizeProductData($_POST);
        $productModel->update($id, $data);
        Helpers::redirect('admin/products');
    }

    public function delete($id)
    {
        $productModel = new Product();
        $productModel->delete($id);
        Helpers::redirect('admin/products');
    }

    public function orders()
    {
        $orderModel = new Order();
        $orders = $orderModel->getAll();
        $this->view('admin/orders_list', ['orders' => $orders], 'layouts/admin_header.php');
    }

    public function orderDetail($id)
    {
        $orderModel = new Order();
        $orderItemModel = new OrderItem();
        $order = $orderModel->find($id);
        if (!$order) {
            Helpers::redirect('admin/orders');
        }
        $items = $orderItemModel->getByOrder($id);
        $this->view('admin/order_detail', ['order' => $order, 'items' => $items], 'layouts/admin_header.php');
    }

    public function updateOrderStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'] ?? 'pending';
            $orderModel = new Order();
            $orderModel->updateStatus($id, $status);
        }
        Helpers::redirect('admin/orderDetail/' . $id);
    }

    private function sanitizeProductData(array $input): array
    {
        $price = (float)($input['price'] ?? 0);
        $stock = (int)($input['stock'] ?? 0);

        return [
            'name' => trim($input['name'] ?? ''),
            'slug' => trim($input['slug'] ?? ''),
            'category_id' => (int)($input['category_id'] ?? 0),
            'price' => $price > 0 ? $price : 0,
            'stock' => $stock >= 0 ? $stock : 0,
            'image' => trim($input['image'] ?? ''),
            'short_desc' => trim($input['short_desc'] ?? ''),
            'description' => trim($input['description'] ?? ''),
            'specs' => trim($input['specs'] ?? ''),
        ];
    }
}
