


<?php


class CategoryController extends CategoryModel{



    public function index(){

        $categories = $this->categories();

        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('index-cate', 'admin', compact('categories'));

        layout('footer', 'admin');

    }

    

    public function add(){


        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('add-cate', 'admin');

        layout('footer', 'admin');

    }


    public function edit($id){

        $category = $this->category($id);



        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('edit-cate', 'admin', compact('category'));

        layout('footer', 'admin');

    }

    function addpost(){

        $request = $_POST;

        $name = $request['name'];

        $sql = "INSERT INTO `categories` (`name`) VALUES ('$name')";

        $this->runSql($sql);

        redirect('?url=cate-index');


    }


    function editpost(){

        $request = $_POST;

        $name = $request['name'];
        $id = $request['id'];

        $sql = "UPDATE categories SET `name`='$name' WHERE `id`='$id'";

        $this->runSql($sql);

        redirect('?url=cate-edit&id='.$id);


    }

    function delete($id){

        $sql = "DELETE FROM categories WHERE id='$id'";

        $this->runSql($sql);

        redirect('?url=cate-index');

    }



}