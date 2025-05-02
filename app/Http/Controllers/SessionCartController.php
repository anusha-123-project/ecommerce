<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SessionCartController extends Controller
{
    public function addCart(Request $request) 
{
    $pid = $request->post('product_id');
    $qty = $request->post('pquantity');

    if ($pid == 0 || $qty == 0) {
        return "Please Select a product";
    }
    //   if set the session or not
     if ($request->session()->has('cart')) {   
        $data = session('cart');        // cart=session variable that stored in the php variable data

        if (in_array($pid, array_column($data, 0))) {
            return "Product already in cart"; 
        }

        array_push($data, [$pid, $qty]);

        session(['cart' => $data]);
    } 
    else 
    {
        session(['cart' => [[$pid, $qty]]]);
    }

    print_r(session('cart'));

    return response()->json(session('cart'));
}

public function removeCart(Request $request, $pid)
{
    if (!$request->session()->has('cart')) {
        return "Cart is empty";
    }

    $cart = session('cart');

    foreach ($cart as $key => $item) {
        if ($item[0] == $pid) {
            unset($cart[$key]);
            session(['cart' => array_values($cart)]); 
            return "Product removed from cart";
        }
    }

    return "Product not found in cart";
}

// public function getCart(Request $request)
// {
//     if ($request->session()->has('cart')) {
//         return response()->json($request->session()->get('cart'));
//     } else {
//         return response()->json(['message' => 'Cart is empty'], 200);
//     }
// }


public function getCart(Request $request)
{
    if ($request->session()->has('cart')) {
        $cart = session('cart');
        // print_r($cart);
        return response()->json($cart);
    } 
    else 
    {
        return "Cart is empty";
    }
}

public function showCartView(Request $request)
{
    $cart = $request->session()->get('cart', []);
    return view('home', compact('cart')); // Replace 'your-cart-view' with your actual Blade file name
}


public function getCartCount(Request $request)
{
    if ($request->session()->has('cart')) {
        $cart = session('cart');
        
        // Assuming cart is an array, you can count the number of items like this:
        $count = count($cart);
        
        return response()->json(['count' => $count]);
        // return response()->json($count);
    } 
    else 
    {
        return response()->json(['count' => 0]);
    }
}

public function sessionDestroy(Request $request)
{
    if ($request->session()->has('cart')) {
        $request->session()->forget('cart'); // Laravel's way to unset a session key
        return "Cart session destroyed";
    } else {
        return "Cart is already empty";
    }
}























public function sessionDestroyy(Request $request)
{
    $cart = session('cart');

    if (isset($cart)) {
        unset($_SESSION['cart']); // Unset using native PHP
        return "Cart session destroyed";
    } else {
        return "Cart is already empty";
    }
}













































    public function addCart1(Request $request, $pid = 0, $qty = 0)
{
    if ($pid == 0 || $qty == 0) {
        return "Please Select a product";
    }

    if ($request->session()->has('cart')) {
        $data = session('cart');

        // Check if product ID already exists
        foreach ($data as $item) {
            if ($item[0] == $pid) {
                return "already in cart";
            }
        }

        array_push($data, [$pid, $qty]);
        session(['cart' => $data]);
    } 
    else 
    {
        session(['cart' => [[$pid, $qty]]]);
    }

    print_r(session('cart'));
    return "ok";
}

    public function addCartt(Request $request,$pid=0,$qty=0)
    {
        if($request->session()->has('cart')){
            $data=session('cart');
            array_push($data,[$pid,$qty]);
            session(['cart'=>$data]); 
        }
        else{
            session(['cart'=>[[$pid,$qty]]]);
        }
      
      if($pid==0 || $qty==0){
        return "Please Select a product";
      }
      print_r(session('cart'));
      return "ok";
     
    }
   
}
