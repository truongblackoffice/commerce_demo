<?php
class Controller
{
    protected $data = [];

    protected function view(string $view, array $data = [], string $layout = 'layouts/header.php')
    {
        extract($data);
        $baseViewPath = __DIR__ . '/../views/';
        $header = $baseViewPath . $layout;
        $footer = strpos($layout, 'admin_') !== false ? 'layouts/admin_footer.php' : 'layouts/footer.php';
        $footerPath = $baseViewPath . $footer;

        if (file_exists($header)) {
            include $header;
        }

        $viewPath = $baseViewPath . $view . '.php';
        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "View {$view} not found";
        }

        if (file_exists($footerPath)) {
            include $footerPath;
        }
    }
}
