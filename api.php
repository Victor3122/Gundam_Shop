<?php


include 'autoload.php';

use Models\CategoryModel;
use Models\MySQL;
use Models\ProductModel;

$mysql = new MySQL();

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json;charset=UTF-8");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('.php', $uri);
$uri = explode('/', $uri[1]);
$request_method = $_SERVER['REQUEST_METHOD'];

if (isset($uri[1]) && $uri[1] == 'categories') {
    $categoryModel = new CategoryModel($mysql);
    if ($request_method == 'GET') {
        if (isset($uri[2]) && $uri[2]) {
            $id = (int)$uri[2];
            $category = $categoryModel->findById($id);
            echo json_encode($category);
        } else {
            $categories = $categoryModel->findAll();
            echo json_encode($categories);
        }
    } else {
        header("HTTP/1.1 400");
        echo "404 Not Found";
    }
} elseif (isset($uri[1]) && $uri[1] == 'products') {
    $productModel = new ProductModel($mysql);
    if ($request_method == 'GET') {
        if (isset($uri[2]) && $uri[2] == 'random') {
            $product = $productModel->findRandom();
            echo json_encode($product);
        } elseif (isset($uri[2]) && $uri[2]) {
            $id = (int)$uri[2];
            $product = $productModel->findById($id);
            echo json_encode($product);
        } else {
            $products = $productModel->findAll();
            echo json_encode($products);
        }
    } else {
        header("HTTP/1.1 400");
        echo "404 Not Found";
    }
}