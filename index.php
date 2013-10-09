<?php
require_once(__DIR__.'/vendor/autoload.php');

$products = array(
	'mbutt' => array(
		'name' => 'Monkey Butter',
		'price' => 12.45,
		'unit' => '16 oz.',
	),

	'bgrease' => array(
		'name' => 'Baboon Grease',
		'price' => 29.95,
		'unit' => '32 oz.',
	),

	'relbearlube' => array(
		'name' => 'Relative Bearing Lubricant',
		'price' => 6.75,
		'unit' => '2 oz.',
	),
);


// App instantiation
$app = new \Slim\Slim(array(
	'view' => new \Slim\Views\Twig(),
));
$app->add(new \Slim\Middleware\SessionCookie());

// Default route
$app->get('/', function () use ($app, $products) {
	$app->render('product-list.html', array('products' => $products));
});

// Product route
$app->get('/product/:code', function ($code) use ($app, $products) {
	$product = $products[$code];
	$app->render('product.html', array('product' => $product, 'code' => $code));
});

// Shopping cart route
$app->get('/cart', function () use ($app, $products) {
	$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	$app->render('cart.html', array('cart' => $cart, 'products' => $products));
});

// Add to cart
$app->post('/add-to-cart', function () use ($app) {
	$code = $app->request->post('code');

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = array();
	}
	if (!isset($_SESSION['cart'][$code])) {
		$_SESSION['cart'][$code] = 0;
	}
	$_SESSION['cart'][$code]++;

	$app->redirect('/cart');
});

// Empty cart
$app->post('/clear-cart', function () use ($app) {
	$_SESSION['cart'] = array();
	$app->redirect('/cart');
});

$app->run();