<?php

require_once '../app/models/ProductsHandler.php';


class Home extends Controller {
    

    public function searchProducts() {

        $instance = new ProductsHandler();

        if(isset($_POST) && count($_POST) > 0)
            $instance->setSearchParameters($_POST['P_ID'], $_POST['P_Manufacturer'], $_POST['P_Name'], $_POST['P_MinPrice'], $_POST['P_MaxPrice']);

        //echo 'home indexing!';

        //$this->showView('home/home_def_view', ['name' => $this->returnModel('Person')->name]);

        $products = $instance->getAllProducts();
        $this->showView('home/Search_Results', $products);      
        
    }

    public function showProductDetailsPage($productId, $source) {

        $instance = new ProductsHandler();
        
        $this->showView('home/ProductDetails', $instance->getProductDetails($productId, $source));

    }
}