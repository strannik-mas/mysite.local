<?php
class Product {
	private $price;
	private $discount;

	function __construct($price, $discount) {
		$this->price = $price;
		$this->discount = $discount;
	}
	function getPrice() {
		return $this->price;
	}
	function getDiscount() {
		return $this->discount;
	}
}

class ProductAdapter {
	private $product;

	function __construct(Product $product) {
		$this->product = $product;
	}
	function getPrice() {
		return $this->product->getPrice() - $this->product->getDiscount();
	}
}


$product1 = new Product(100, 20);
echo 'Discounted price = '.($product1->getPrice() - $product1->getDiscount()).'</br>';

$product2 = new ProductAdapter($product1);
echo 'Discounted price 2= '.$product2->getPrice();
?>