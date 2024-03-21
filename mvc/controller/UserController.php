<?php


class UserController extends UserModel{



    public function index(){

        $users = $this->users();

        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('index-user', 'admin', compact('users'));

        layout('footer', 'admin');

    }

    

    public function add(){


        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('add-user', 'admin');

        layout('footer', 'admin');

    }


    public function edit($id){

        $user = $this->user($id);

        layout('header', 'admin');
        layout('sidebar', 'admin');

        view('edit-user', 'admin', compact('user'));

        layout('footer', 'admin');

    }

    function addpost(){

        $request = $_POST;

        $fullname = $request['fullname'];
        $email = $request['email'];
        $password = $request['password'];
        $permission = 0;

        $sql = "INSERT INTO `users` (`fullname`, `email`, `password`, `permission`) VALUES ('$fullname', '$email', '$password', '$permission')";

        $this->runSql($sql);

        redirect('?url=user-index');


    }


    function editpost(){

        $request = $_POST;

        $fullname = $request['fullname'];
        $email = $request['email'];
        $password = $request['password'];
        $id = $request['id'];

        $sql = "UPDATE users SET `fullname`='$fullname', `email`='$email', `password`='$password' WHERE `id`='$id'";

        $this->runSql($sql);

        redirect('?url=user-edit&id='.$id);


    }

    function delete($id){

        $sql = "DELETE FROM users WHERE id='$id'";

        $this->runSql($sql);

        redirect('?url=user-index');

    }



}