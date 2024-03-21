<?php


class ProductController extends ProductModel{



    public function index(){

        $products = $this->products();

        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('index-product', 'admin', compact('products'));

        layout('footer', 'admin');

    }

    

    public function add(){

        $categories = $this->categories();

        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('add-product', 'admin', compact(['categories']));

        layout('footer', 'admin');

    }


    public function edit($id){

        $product = $this->product($id);

        $categories = $this->categories();

        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('edit-product', 'admin', compact(['categories', 'product']));

        layout('footer', 'admin');
    }

    function addpost(){

        $request = $_POST;

        $name = $request['name'];
        $price = $request['price'];
        $description = $request['description'];
        $cate_id = $request['cate_id'];



        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image'];
            $nameImage = time().'_'.$image['name'];
            $toFile =  _WEB_PATH_ROOT.'/public/image/'.$nameImage;          
            move_uploaded_file($image['tmp_name'], $toFile);
        }

        $sql = "INSERT INTO `products` (`name`, `price`, `description`, `cate_id`, `image`) VALUES ('$name', '$price', '$description', '$cate_id', '$nameImage')";

        $this->runSql($sql);

        redirect('?url=product-index');


    }


    function editpost(){

        $request = $_POST;

        $name = $request['name'];
        $price = $request['price'];
        $description = $request['description'];
        $cate_id = $request['cate_id'];
        $id = $request['id'];

        $setImg = '';

        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image'];
            $nameImage = time().'_'.$image['name'];
            $toFile =  _WEB_PATH_ROOT.'/public/image/'.$nameImage;          
            move_uploaded_file($image['tmp_name'], $toFile);
            $setImg = ", `image`='$nameImage'";
        }

        $sql = "UPDATE  `products` SET `name`='$name', `price`='$price', `description`='$description', `cate_id`='$cate_id' $setImg WHERE id='$id'";

        // echo $sql;

        // die;

        $this->runSql($sql);

        redirect('?url=product-index');


    }

    function delete($id){

        $sql = "DELETE FROM products WHERE id='$id'";

        $this->runSql($sql);

        redirect('?url=product-index');

    }



}