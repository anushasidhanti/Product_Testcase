<?php 
require_once '../app/models/DatabaseAccessHandler.php';
require_once '../app/models/Product.php';
class ProductsHandler extends DatabaseAccessHandler {

    public $p_id;
    public $p_manuf = '';
    public $p_name = '';
    public $p_min_price, $p_max_price;

    public function setSearchParameters($p_id, $p_manuf, $p_name, $p_min_price, $p_max_price) {

        $this->p_id = $p_id;
        $this->p_manuf = $p_manuf;
        $this->p_name = $p_name;
        $this->p_min_price = $p_min_price;
        $this->p_max_price = $p_max_price;
    }

    public function getAllProducts() {

        $data = $this->getProductsFromDB();

        $data = array_merge($data, $this->getProductsFromXMLSource());

        //get products from any other format/source here and merge the results (json for example, coming from a web service)

        $data = array_filter($data, function($item) {

            //print_r($item->id . '<br>');
            if($this->p_id != '') {
                if($item->id  == $this->p_id) return true; else return false;
            }
            elseif($this->p_manuf != '') {
                if (stripos($item->manufacturer, $this->p_manuf) !== false) {
                    return true;
                } else return false;
            }
            elseif($this->p_name != '') {
                if (stripos($item->name, $this->p_name) !== false) {
                    return true;
                } else return false;
            }
            elseif($this->p_min_price != '') {
                if ($item->price >=  $this->p_min_price) {
                    return true;
                } else return false;
            }
            elseif($this->p_max_price != '') {
                if ($item->price <=  $this->p_max_price) {
                    return true;
                } else return false;
            }
            else return true;
            
        });

        return $data;
        
    }

    public function getProductsFromDB() {

        $sqlQuery = 'select * from products';

        $result = $this->connect()->query($sqlQuery);
        if($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {

                $productInstance = new Product($row['id'], $row['manufacturer'], $row['name'], $row['additional_info'], $row['price'],
                    $row['availability'], $row['product_image'], Product::DB_SOURCE);
            
                $data[] = $productInstance;
            }
            return $data;
        }
    }

    public function getProductsFromXMLSource() {

        $objDOM = new DOMDocument();
    
        //Load xml file into DOMDocument variable
        //This xml could also come from internet (web service, for example), here it is assumed that it is present in the local machine
        $objDOM->load("../app/datasources/products.xml");

        //Find Tag element "config" and return the element to variable $node
        $products = $objDOM->getElementsByTagName("product");

        foreach($products as $product) {

            $id = $product->getElementsByTagName("id");
            $idVal  = $id->item(0)->nodeValue;

            $manufacturer = $product->getElementsByTagName("manufacturer");
            $manufacturerVal  = $manufacturer->item(0)->nodeValue;

            $name = $product->getElementsByTagName("name");
            $nameVal  = $name->item(0)->nodeValue;

            $additional_info = $product->getElementsByTagName("additional_info");
            $additional_infoVal  = $additional_info->item(0)->nodeValue;

            $price = $product->getElementsByTagName("price");
            $priceVal  = $price->item(0)->nodeValue;

            $availability = $product->getElementsByTagName("availability");
            $availabilityVal  = $availability->item(0)->nodeValue;

            $product_image = $product->getElementsByTagName("product_image");
            $product_imageVal  = $product_image->item(0)->nodeValue;

            $productInstance = new Product($idVal, $manufacturerVal, $nameVal, 
                $additional_infoVal, $priceVal, $availabilityVal, $product_imageVal, Product::XML_SOURCE);
            
            $data[] = $productInstance;

        }
        return $data;
    }

    public function getProductDetails($Product_ID, $source) {

        if($source == Product::DB_SOURCE) {

            $sqlQuery = 'select * from products where id=' . $Product_ID;

            $result = $this->connect()->query($sqlQuery);

            $row = mysqli_fetch_assoc($result);

            return new Product($row['id'], $row['manufacturer'], $row['name'], $row['additional_info'], $row['price'],
                        $row['availability'], $row['product_image'], Product::DB_SOURCE);


        } elseif($source == Product::XML_SOURCE) {

            $objDOM = new DOMDocument();
    
            //Load xml file into DOMDocument variable
            $objDOM->load("../app/datasources/products.xml");

            //Find Tag element "config" and return the element to variable $node
            $products = $objDOM->getElementsByTagName("product");

            foreach($products as $product) {

                $id = $product->getElementsByTagName("id");
                $idVal  = $id->item(0)->nodeValue;

                if($idVal == $Product_ID) {

                    $manufacturer = $product->getElementsByTagName("manufacturer");
                    $manufacturerVal  = $manufacturer->item(0)->nodeValue;

                    $name = $product->getElementsByTagName("name");
                    $nameVal  = $name->item(0)->nodeValue;

                    $additional_info = $product->getElementsByTagName("additional_info");
                    $additional_infoVal  = $additional_info->item(0)->nodeValue;

                    $price = $product->getElementsByTagName("price");
                    $priceVal  = $price->item(0)->nodeValue;

                    $availability = $product->getElementsByTagName("availability");
                    $availabilityVal  = $availability->item(0)->nodeValue;

                    $product_image = $product->getElementsByTagName("product_image");
                    $product_imageVal  = $product_image->item(0)->nodeValue;

                    return new Product($idVal, $manufacturerVal, $nameVal, 
                        $additional_infoVal, $priceVal, $availabilityVal, $product_imageVal, Product::XML_SOURCE);

                }
            }

        }
    }
}