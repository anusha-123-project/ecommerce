<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Media;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    { 
        $categories = Category::with('parent')->get();
        $products=Product::all();
        $cart = $request->session()->get('cart', []);
        return view('home',compact('categories','products','cart'));
    }
}
