<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../core/Helpers.php';

class CategoryController extends Controller
{
    public function index()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('products/index', [
            'categories' => $categories,
            'products' => [],
            'page' => 1,
            'totalPages' => 1,
            'currentCategory' => null,
        ]);
    }
}
