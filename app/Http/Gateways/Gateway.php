<?php


namespace App\Http\Gateways;
use App\Interfaces\RepositoryInterface;


class Gateway
{
    public function __construct(RepositoryInterface $R) {
        $this->R = $R;
    }

    public function createNote($request, $id=null) {
        $request->validate([
            'name' => 'required|string|max:30',
            'content' => 'required|string'
        ]);
        if(isset($id))
            return $this->R->createNote($request, $id);
        else
            return $this->R->createNote($request);
    }

    public function createWholesale($request, $id=null) {
        $request->validate([
            'name' => 'required|string|max:30'
        ]);
        if(isset($id))
            return $this->R->createWholesale($request, $id);
        else
            return $this->R->createWholesale($request);

    }

    public function createSet($request, $id=null) {
        $request->validate([
            'name' => 'required|string|max:120',
            'netto_price' => 'required|numeric',
            'in_store' => 'required|numeric',
            'content' => 'required|string'
        ]);
        if(isset($id))
            return $this->R->createSet($request, $id);
        else
            return $this->R->createSet($request);
    }

    public function setStore($request, $id) {
        $request->validate([
            'in_store' => 'required|numeric'
        ]);
        return $this->R->setStore($request, $id);
    }

    public function createCategory($request, $id=null) {
        $request->validate([
            'name' => 'required|string|max:30'
        ]);
        if(isset($id))
            return $this->R->createCategory($request, $id);
        else
            return $this->R->createCategory($request);

    }

    public function createProduct($request, $id=null) {
        $request->validate([
            'name' => 'required|string|max:120',
            'id_wholesale' => 'required|string|max:120',
            'category_id' => 'required|numeric',
            'color' => 'required|string|max:30',
            'pattern' => 'required|string|max:30',
            'quantity' => 'required|numeric',
            'netto_price' => 'required|numeric',
            'in_store' => 'required|numeric',
            'wholesale_id' => 'required|numeric'
        ]);
        if(isset($id))
            return $this->R->createProduct($request, $id);
        else
            return $this->R->createProduct($request);

    }

    public function createAccessory($request, $id=null) {
        $request->validate([
            'name' => 'required|string|max:120',
            'id_wholesale' => 'required|string|max:120',
            'quantity' => 'required|numeric',
            'netto_price' => 'required|numeric',
            'in_store' => 'required|numeric',
            'wholesale_id' => 'required|numeric'
        ]);
        if(isset($id))
            return $this->R->createAccessory($request, $id);
        else
            return $this->R->createAccessory($request);

    }

    public function sellSet($request, $id) {
        $request->validate([
            'quantity' => 'required|numeric|gt:0'
        ]);
        if($request->sell)
            return $this->R->sellSet($request, $id);
        else
            return $this->R->returnSet($request, $id);
    }

    public function sellProduct($request, $id) {
        $request->validate([
            'quantity' => 'required|numeric|gt:0'
        ]);
        if($request->sell)
            return $this->R->sellProduct($request, $id);
        else
            return $this->R->returnProduct($request, $id);
    }

    public function sellAccessory($request, $id) {
        $request->validate([
            'quantity' => 'required|numeric|gt:0'
        ]);
        if($request->sell)
            return $this->R->sellAccessory($request, $id);
        else
            return $this->R->returnAccessory($request, $id);
    }

    public function searchSets($request) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedSets($term);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedSets($request) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getSetsResult($request->input('name'));

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }

    public function searchProducts($request, $id) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedProducts($term, $id);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedProducts($request, $id) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getProductsResult($request->input('name'), $id);

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }

    public function searchAccessories($request) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedAccessories($term);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedAccessories($request) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getAccessoriesResult($request->input('name'));

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }

    public function searchProductsSell($request) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedProductsSell($term);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedProductsSell($request) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getProductsSellResult($request->input('name'));

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }

    public function searchSetsSell($request) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedSetsSell($term);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedSetsSell($request) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getSetsSellResult($request->input('name'));

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }

    public function searchAccessoriesSell($request) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedAccessoriesSell($term);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedAccessoriesSell($request) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getAccessoriesSellResult($request->input('name'));

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }
    public function searchNote($request) {
        $term = $request->input('term');
        $results = [];
        $queries = $this->R->getSearchedNotes($term);

        foreach($queries as $query){
            $result[] = ['id' => $query->id, 'value' => $query->name];
        }

        return $result;
    }

    public function getSearchedNotes($request) {
        $request->flash();

        if($request->input('name') != null) {
            $result = $this->R->getNotesResult($request->input('name'));

            if(count($result) > 0)
                return $result;
            else
                return false;
        }

        return false;
    }

}
