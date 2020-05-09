<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\RepositoryInterface;
use App\Http\Gateways\Gateway;
class StoreController extends Controller
{

    public function __construct(RepositoryInterface $R, Gateway $G) {
        $this->R = $R;
        $this->G = $G;
    }

    public function index() {
        $categories = $this->R->getCategories();
        $accessories = $this->R->getAccessories();
        return view('store.index', ['categories' => $categories, 'accessories' => $accessories]);
    }

    public function showProducts($id) {
        $products = $this->R->getProducts($id);
        $category = $this->R->getCategory($id);
        return view('store.showProducts', ['products' => $products, 'category' => $category]);
    }

    public function showAccessories() {
        $accesories = $this->R->getAccessories();
        return view('store.showAccessories',['accessories' => $accesories]);
    }

    public function addCategory() {
        return view('store.addCategory');
    }

    public function editCategory($id) {
        $category = $this->R->getCategory($id);
        return view('store.addCategory', ['category' => $category]);
    }

    public function storeCategory(Request $request, $id=null) {
        if(isset($id)){
            $this->G->createCategory($request, $id);
            return redirect()->route('store');
        } else {
            $this->G->createCategory($request);
            return redirect()->route('store');
        }
    }

    public function deleteCategory($id) {
        $category = $this->R->deleteCategory($id);
        return redirect()->route('store');
    }

    public function addProduct() {
        $categories = $this->R->getCategories();
        $wholesales = $this->R->getWholesales();
        return view('store.addProduct', ['categories' => $categories, 'wholesales' => $wholesales]);
    }

    public function editProduct($id) {
        $product = $this->R->getProduct($id);
        $categories = $this->R->getCategories();
        $wholesales = $this->R->getWholesales();
        return view('store.addProduct', ['product' => $product, 'categories' => $categories, 'wholesales' => $wholesales]);
    }

    public function storeProduct(Request $request, $id=null) {
        if(isset($request->category_id)){
            $cat = $request->category_id;
            $category = $this->R->getCategory($cat);
        }
        if(isset($id)){
            $this->G->createProduct($request, $id);
            return redirect()->route('showProducts', ['id' => $category->id, 'name' => $category->name]);
        } else {
            $this->G->createProduct($request);
            return redirect()->route('store');
        }
    }

    public function deleteProduct($id) {
        $product = $this->R->deleteProduct($id);
        return redirect()->back();
    }

    public function addAccessory() {
        $wholesales = $this->R->getWholesales();
        return view('store.addAccessory', ['wholesales' => $wholesales]);
    }

    public function editAccessory($id) {
        $wholesales = $this->R->getWholesales();
        $accessory = $this->R->getAccessory($id);
        return view('store.addAccessory', ['accessory' => $accessory, 'wholesales' => $wholesales]);
    }

    public function storeAccessory(Request $request, $id=null) {
        if(isset($id)){
            $this->G->createAccessory($request, $id);
            return redirect()->route('store');
        } else {
            $this->G->createAccessory($request);
            return redirect()->route('store');
        }
    }

    public function deleteAccessory($id) {
        $accessory = $this->R->deleteAccessory($id);
        return redirect()->back();
    }

    public function searchProducts(Request $request, $id) {
        $results = $this->G->searchProducts($request, $id);
        return response()->json($results);
    }

    public function productsResults(Request $request, $id) {
        $category = $this->R->getCategory($id);
        if($products = $this->G->getSearchedProducts($request, $id)){
            return view('store.showProducts', ['products' => $products, 'category' => $category]);
        } else {
            return redirect('/store/products/'.$id.'/'.$category->name)->with('no_products', 'Brak produktów o podanej nazwie.');
        }
    }

    public function searchAccessories(Request $request) {
        $results = $this->G->searchAccessories($request);
        return response()->json($results);
    }

    public function accessoryResults(Request $request) {
        if($accessories = $this->G->getSearchedAccessories($request)){
            return view('store.showAccessories', ['accessories' => $accessories]);
        } else {
            return redirect('/store/accessories')->with('no_accessories', 'Brak akcesorów o podanej nazwie.');
        }
    }
}
