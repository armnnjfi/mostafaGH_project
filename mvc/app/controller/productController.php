<?php

include "app/policies/userPolicy.php";
// include 'core/controller.php';
class productController extends controller{
    use UserPolicy;  
    public function show_products(){
        // $connection = new mysqli('localhost','root','','test-database');
        // $query = "SELECT * FROM products";
        // $result = $connection->prepare($query);
        // $result->execute();
        // $products = $result->get_result();

        include 'app/model/product.php';
        $new_product = new product();
        $products = $new_product->getProducts();

        // $this->nav('header');
        $this->view('productList', ['product'=>$products]);
    }
    public function show_product($slug){
        if(!$this->is_admin()){
            return var_dump('error ACL');
        }
        echo $slug;
    }
}
?>