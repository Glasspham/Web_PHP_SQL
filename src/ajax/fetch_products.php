<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . "/../classes/product.php");
$product = new product();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$type = isset($_GET['type']) ? $_GET['type'] : 'new';
if ($type === "new") $result = $product->getProductNew($page);
else $result = $product->getProductFeatured($page);
$response = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => $row['productId'],
            'name' => $row['productName'],
            'price' => number_format($row['price']),
            'image' => $row['image'],
            'quantity' => (int)$row['quantity'],
        ];
    }
}
header('Content-Type: application/json');
echo json_encode($response);
?>