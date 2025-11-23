<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../core/Helpers.php';

class ProductController extends Controller
{
    public function index($categorySlug = null)
    {
        $productModel = new Product();
        $categoryModel = new Category();

        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 9;
        $offset = ($page - 1) * $limit;

        $category = null;
        if ($categorySlug) {
            $category = $categoryModel->findBySlug($categorySlug);
        }

        $products = $productModel->getAll($limit, $offset, $category ? $category['id'] : null);
        $total = $productModel->countAll($category ? $category['id'] : null);
        $totalPages = (int)ceil($total / $limit);

        $this->view('products/index', [
            'products' => $products,
            'categories' => $categoryModel->getAll(),
            'page' => $page,
            'totalPages' => $totalPages,
            'currentCategory' => $category,
        ]);
    }

    public function detail($id)
    {
        $productModel = new Product();
        $product = $productModel->find($id);

        if (!$product) {
            http_response_code(404);
            echo 'Product not found';
            return;
        }

        $this->view('products/detail', [
            'product' => $product,
        ]);
    }
}
