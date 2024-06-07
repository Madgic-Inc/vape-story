<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $products = DB::table('products')->where('stock', '>', 0)->orderByDesc('id')->get();
        return view('admin.home')->with(['products' => $products]);
    }

    public function showProducts()
    {
        $products = DB::table('products')->where('stock', '>', 0)->orderByDesc('id')->get();
        return view('admin.list-products')->with([
            'products' => $products
        ]);
    }

    public function createProduct()
    {
        return view('admin.create-product');
    }


    public function storeProduct(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required',
                'value' => 'required|numeric',
                'stock' => 'required|integer',
                'description' => 'required',
                'image' => 'required',
            ]);

            $product = DB::table('products')->create([
                'name' => $request->name,
                'value' => $request->value,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => null,
            ]);

            $pathImage = Storage::disk('public')->putFile('products-' . $product->id, $request->file('image'));

            $product->update([
                'image' => $pathImage,
            ]);

            $allProducts = DB::table('products')->where('stock', '>', 0)->orderByDesc('id')->get();

            return view('admin.list-products')->with([
                'success' => 'Produto ' . $product->name . ' criado com sucesso',
                'products' => $allProducts
            ],

            );
        } catch (Exception $e) {
            return view('admin.list-products')->with([
                'error' => 'Erro ao criar produto: ' . $e->getMessage(),
                'products' => $allProducts
            ]);
        }
    }

    public function updateProduct($id, Request $request)
    {
        try {

            $product = DB::table('products')->where('id', '=', $id)->first();

            $product->update([
                'name' => $request->name,
                'value' => $request->value,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);

            $products = DB::table('products')->where('stock', '>', 0)->orderByDesc('id')->get();

            return view('admin.list-products')->with([
                'success' => 'Produto ' . $product->name . ' atualizado com sucesso',
                'products' => $products
            ]);
        } catch (Exception $e) {
            return view('admin.list-products')->with([
                'error' => 'Erro ao atualizar produto: ' . $e->getMessage(),
                'products' => $products
            ]);
        }
    }

    public function deleteProduct($id, Product $product)
    {
        try {
            $product = DB::table('products')->where('id', '=', $id)->first();
            $product->delete();

            $products = Product::where('stock', '>', 0)->orderByDesc('id')->get();

            return view('admin.list-products')->with([
                'success' => 'Produto ' . $product->name . ' deletado com sucesso',
                'products' => $products
            ]);
        } catch (Exception $e) {
            return view('admin.list-products')->with([
                'error' => 'Erro ao deletar produto: ' . $e->getMessage(),
                'products' => $products
            ]);
        }
    }
}
