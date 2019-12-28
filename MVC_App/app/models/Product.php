<?php

class Product {

    public $id;
    public $manufacturer = '';
    public $name = '';
    public $additional_info = '';
    public $price;
    public $availability;
    public $product_image = '';
    public $source = '';

    const DB_SOURCE = "DB";
    const XML_SOURCE = "XML";

    public function __construct($id, $manufacturer, $name, $add_info, $price, $availability, $product_image, $source) {

        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->name = $name;
        $this->additional_info = $add_info;
        $this->price = $price;
        $this->availability = $availability;
        $this->product_image = $product_image;

        $this->source = $source;
    }

    
}