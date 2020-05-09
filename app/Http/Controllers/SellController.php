<?php

namespace App\Http\Controllers;

use App\Http\Gateways\Gateway;
use App\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function __construct(RepositoryInterface $R, Gateway$G) {
        $this->R = $R;
        $this->G = $G;
    }

    public function index() {
        $count = $this->R->getCountedSales();
        return view('sell.index', ['count' => $count]);
    }

    public function showSets() {
        $sets = $this->R->getSoldSets();
        return view('sell.sets', ['sets' => $sets]);
    }

    public function setsStats() {
        $sets = $this->R->getSoldSetsStats();
        return view('sell.setsStats', ['sets' => $sets]);
    }

    public function sellSet(Request $request, $id) {
        $set = $this->G->sellSet($request, $id);
        return redirect()->back();
    }

    public function showProducts() {
        $products = $this->R->getSoldProducts();
        return view('sell.products', ['products' => $products]);
    }

    public function productsStats() {
        $products = $this->R->getSoldProductsStats();
        return view('sell.productsStats', ['products' => $products]);
    }

    public function sellProduct(Request $request, $id) {
        $product = $this->G->sellProduct($request, $id);
        return redirect()->back();
    }

    public function showAccessories() {
        $accessories = $this->R->getSoldAccessories();
        return view('sell.accessories', ['accessories' => $accessories]);
    }

    public function accessoriesStats() {
        $accessories = $this->R->getSoldAccessoriesStats();
        return view('sell.accessoriesStats', ['accessories' => $accessories]);
    }

    public function sellAccessory(Request $request, $id) {
        $accessory = $this->G->sellAccessory($request, $id);
        return redirect()->back();
    }

    public function searchProduct(Request $request) {
        $results = $this->G->searchProductsSell($request);
        return response()->json($results);
    }

    public function productResults(Request $request) {
        if($products = $this->G->getSearchedProductsSell($request)){
            return view('sell.products', ['products' => $products]);
        } else {
            return redirect('/sell/products')->with('no_products', 'Brak produktów o podanej nazwie.');
        }
    }

    public function searchSet(Request $request) {
        $results = $this->G->searchSetsSell($request);
        return response()->json($results);
    }

    public function setResults(Request $request) {
        if($sets = $this->G->getSearchedSetsSell($request)){
            return view('sell.sets', ['sets' => $sets]);
        } else {
            return redirect('/sell/sets')->with('no_sets', 'Brak zestawów o podanej nazwie.');
        }
    }

    public function searchAccessory(Request $request) {
        $results = $this->G->searchAccessoriesSell($request);
        return response()->json($results);
    }

    public function accessoryResults(Request $request) {
        if($accessories = $this->G->getSearchedAccessoriesSell($request)){
            return view('sell.accessories', ['accessories' => $accessories]);
        } else {
            return redirect('/sell/accessories')->with('no_accessories', 'Brak akcesorów o podanej nazwie.');
        }
    }
}
