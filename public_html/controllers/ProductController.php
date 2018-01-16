<?php

require_once(ROOT . '/components/Cart.php');
require_once(ROOT . '/models/Category.php');
require_once(ROOT . '/models/Product.php');

class ProductController {
    
    public function actionView($product_id){
        
        $product_id = $product_id;
        $product_info = Product::getProductInfo($product_id);
        if($product_info){
            $meta_name = lcfirst($product_info['product_name']);

            $title = $product_info['product_name'] . ', ' . $product_info['category']['parent_name'] . ', ' . $product_info['category']['cat_name'];
            
            $sizes = Product::getSizes($product_id);
            $categories = Category::getCategory($product_info['category']['cat_id']);
            $images = Product::getImages($product_info['category']['parent_abbr'], $product_info['category']['cat_abbr'], $product_info['product_id']);

            require_once(ROOT . '/views/product/view.php');

        } else {
            require_once(ERROR404);
        }
        
        return true; 
        
    }
    
}

?>