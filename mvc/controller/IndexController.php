<?php


class IndexController extends IndexModel{

    public function home(){

        $categories = $this->categories();
        $products = $this->products();

    
        layout('header');
        layout('sidebar', 'client', compact('categories'));

        view('home', 'client', compact(['categories', 'products']));


        layout('footer');

    
    }

    public function detail($id){

        $categories = $this->categories();
        // $products = $this->products();
        $product = $this->product($id);

    
        layout('header');
        layout('sidebar', 'client', compact('categories'));

        view('detail', 'client', compact(['categories', 'product']));


        layout('footer');

    
    }

    public function addCart($id){

        if(!$_SESSION['cart']){

            $_SESSION['cart'][] = [
                'id' => $id,
                'quantity' => 1
            ];

        }else{

            $check = true;
            foreach ($_SESSION['cart'] as $key => $value) {
                if($value['id'] == $id){
                    $quantity = $_SESSION['cart'][$key]['quantity'];
                    $_SESSION['cart'][$key]['quantity'] = $quantity + 1;
                    $check = false;
                    break;
                }
            }

            if($check){
                $_SESSION['cart'][] = [
                    'id' => $id,
                    'quantity' => 1
                ];
            }

        }

        redirect('?url=cart');

    }

    function downCart($id){


        if($_SESSION['cart']){

            $index = 0;

            foreach ($_SESSION['cart'] as $key => $value) {
                if($value['id'] == $id){
                    $quantity = $_SESSION['cart'][$key]['quantity'];
                    $_SESSION['cart'][$key]['quantity'] = $quantity - 1;
                    $index = $key;
                    break;
                }
            }

            if($_SESSION['cart'][$index]['quantity'] <= 0){
                unset($_SESSION['cart'][$index]);
            }

        }

        redirect('?url=cart');

    }

    function cart(){


        $cart = $this->giohang(); 
        $categories = $this->categories();


        layout('header');
        layout('sidebar', 'client', compact('categories'));

        view('cart', 'client', compact(['cart']));


        layout('footer');

    }

    function removeCart($key){

        if($_SESSION['cart']) unset($_SESSION['cart'][$key]);

        redirect('?url=cart');

    }


    function login(){

        if(!empty($_SESSION['account'])) redirect();

        $categories = $this->categories();
        
        layout('header');
        layout('sidebar', 'client', compact('categories'));

        view('login', 'client');


        layout('footer');

    }

    function loginPost(){

        if(!empty($_SESSION['account'])) redirect();

        $responses = $_POST;

        $email = $responses['email'];
        $password = $responses['password'];

        $this->loginHandle($email, $password);


    }


    function forgot(){

        if(!empty($_SESSION['account'])) redirect();

        $categories = $this->categories();
        
        layout('header');
        layout('sidebar', 'client', compact('categories'));

        view('forgot', 'client');


        layout('footer');


    }



    function forgotPost(){

        if(!empty($_SESSION['account'])) redirect();

        $responses = $_POST;

        $email = $responses['email'];

        $user = $this->user($email);

        $content = '
Mậu khẩu của bạn là: '.$user['password'].'
';

       $send = sendMail($email, "EMAIL NHẬP MẬT KHẨU ĐÃ QUÊN", $content);

       if($send){
        $_SESSION['email'] = "Chúng tôi đã gửi mật khẩu tới mail của bạn";
        }

        redirect('?url=login');

    }


    function logout(){

        if(empty($_SESSION['account'])) redirect();

        unset($_SESSION['account']);

        redirect('?url=login');

    }


}

