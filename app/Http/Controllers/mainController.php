<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $products = Product::where('stock', '>', 0)->orderByDesc('id')->get();
        return view('welcome')->with(['products' => $products]);
    }


}
