<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\RepositoryInterface;
use App\Http\Gateways\Gateway;

class WholesaleController extends Controller
{
    public function __construct(RepositoryInterface $R, Gateway $G) {
        $this->R = $R;
        $this->G = $G;
    }
    public function index() {
        $wholesales = $this->R->getWholesales();
        return view('wholesales.index', ['wholesales' => $wholesales]);
    }

    public function show($id) {
        $wholesale = $this->R->getWholesale($id);
        return view('wholesales.show', ['wholesale' => $wholesale]);
    }

    public function add() {
        return view('wholesales.addWholesale');
    }

    public function edit($id) {
        $wholesale = $this->R->getWholesale($id);
        return view('wholesales.addWholesale', ['wholesale' => $wholesale]);
    }

    public function store(Request $request, $id=null) {
        if(isset($id)){
            $this->G->createWholesale($request, $id);
            return redirect()->route('wholesales');
        } else {
            $this->G->createWholesale($request);
            return redirect()->route('wholesales');
        }
    }

    public function delete($id) {
        $wholesale = $this->R->deleteWholesale($id);
        return redirect()->route('wholesales');
    }
}
