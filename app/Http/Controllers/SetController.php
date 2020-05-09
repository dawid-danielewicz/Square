<?php

namespace App\Http\Controllers;

use App\Http\Gateways\Gateway;
use App\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;

class SetController extends Controller
{
    public function __construct(RepositoryInterface $R, Gateway$G) {
        $this->R = $R;
        $this->G = $G;
    }

    public function index() {
        $sets = $this->R->getSets();
        return view('sets.index',['sets' => $sets]);
    }

    public function show($id) {
        $set = $this->R->getSet($id);
        return view('sets.show',['set' => $set]);
    }

    public function add() {
        return view('sets.addSet');
    }

    public function edit($id) {
        $set = $this->R->getSet($id);
        return view('sets.addSet', ['set' => $set]);
    }

    public function store(Request $request, $id=null) {
        if(isset($id)) {
            $set = $this->G->createSet($request, $id);
            return redirect()->route('showSet',['id' => $id]);
        } else {
            $set = $this->G->createSet($request);
            return redirect()->route('sets');
        }
    }

    public function delete($id) {
        $set = $this->R->deleteSet($id);
        return redirect()->route('sets');
    }

    public function setStore(Request $request, $id) {
        $set = $this->G->setStore($request, $id);
        return redirect()->back();
    }

    public function searchSets(Request $request) {
        $results = $this->G->searchSets($request);
        return response()->json($results);
    }

    public function searchResults(Request $request) {
        if($sets = $this->G->getSearchedSets($request)){
            return view('sets.search', ['sets' => $sets]);
        } else {
            return redirect('/sets')->with('no_sets', 'Brak zestawów o podanej nazwie.');
        }
    }
}
