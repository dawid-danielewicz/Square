<?php


namespace App\Http\Repositories;

use App\Interfaces\RepositoryInterface;
use App\{Accessory, Category, Note, Product, Sale, Set, Wholesale};
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;


class Repository implements RepositoryInterface
{

    public function getWholesales()
    {
        return Wholesale::with('products', 'accessories')->get();
    }

    public function getWholesale($id)
    {
        return Wholesale::with('products', 'accessories')->findOrFail($id);
    }

    public function getAccessories()
    {
        return Accessory::with('wholesale')->get();
    }

    public function getNotes()
    {
        return Note::latest()->paginate(27);
    }

    public function getSets()
    {
        return Set::all();
    }

    public function getSet($id)
    {
        return Set::findOrFail($id);
    }

    public function createNote($request, $id = null)
    {
        if (isset($id)) {
            $note = Note::findOrFail($id);
        } else {
            $note = new Note;
        }
        $note->name = $request->input('name');
        $note->content = $request->input('content');
        return $note->save();
    }

    public function getNote($id)
    {
        return Note::findOrFail($id);
    }

    public function deleteNote($id)
    {
        $note = Note::findOrFail($id);
        return $note->delete();
    }

    public function createWholesale($request, $id = null)
    {
        if (isset($id)) {
            $wholesale = Wholesale::findOrFail($id);
        } else {
            $wholesale = new Wholesale;
        }
        $wholesale->name = $request->input('name');
        return $wholesale->save();
    }

    public function deleteWholesale($id)
    {
        $wholesale = Wholesale::findOrFail($id);
        return $wholesale->delete();
    }

    public function createSet($request, $id = null)
    {
        if (isset($id)) {
            $set = Set::findOrFail($id);
        } else {
            $set = new Set;
        }
        $set->name = $request->input('name');
        $set->netto_price = $request->input('netto_price');
        $set->brutto_price = $set->netto_price + ($set->netto_price * 0.23);
        $set->in_store = $request->input('in_store');
        $set->content = $request->input('content');
        $set->save();
        $sale = new Sale;
        $sale->quantity = 0;
        $sale->saleable_type = 'App\Set';
        $sale->saleable_id = $set->id;
        $sale->save();
        return;
    }

    public function deleteSet($id)
    {
        $set = Set::findOrFail($id);
        $set->sales->delete();
        $set->delete();
        Session::flash('deleted_set', 'Pomyślnie usunięto zestaw.');
        return;
    }

    public function setStore($request, $id)
    {
        $set = Set::findOrFail($id);
        $set->in_store = $request->input('in_store');
        $set->save();
        Session::flash('updated_sets', 'Zmieniono ilość zestawów w magazynie.');
        return;
    }

    public function getCategories()
    {
        return Category::with('products')->get();
    }

    public function getProducts($id)
    {
        return $products = Product::with('category', 'wholesale')->where('category_id', $id)->get();
    }

    public function createCategory($request, $id = null)
    {
        if (isset($id)) {
            $category = Category::findOrFail($id);
        } else {
            $category = new Category;
        }
        $category->name = $request->input('name');
        return $category->save();
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }

    public function getCategory($id)
    {
        return $category = Category::findOrFail($id);
    }

    public function createProduct($request, $id = null)
    {
        if (isset($id)) {
            $product = Product::findOrFail($id);
            $product->name = $request->input('name');
            $product->id_wholesale = $request->input('id_wholesale');
            $product->category_id = $request->input('category_id');
            $product->color = $request->input('color');
            $product->pattern = $request->input('pattern');
            $product->quantity = $request->input('quantity');
            $product->netto_price = $request->input('netto_price');
            $product->brutto_price = $product->netto_price + ($product->netto_price * 0.23);
            $product->price_per_piece = $product->netto_price / $product->quantity;
            $product->in_store = $request->input('in_store');
            $product->wholesale_id = $request->input('wholesale_id');
            $product->save();
        } else {
            $product = new Product;
            $product->name = $request->input('name');
            $product->id_wholesale = $request->input('id_wholesale');
            $product->category_id = $request->input('category_id');
            $product->color = $request->input('color');
            $product->pattern = $request->input('pattern');
            $product->quantity = $request->input('quantity');
            $product->netto_price = $request->input('netto_price');
            $product->brutto_price = $product->netto_price + ($product->netto_price * 0.23);
            $product->price_per_piece = $product->netto_price / $product->quantity;
            $product->in_store = $request->input('in_store');
            $product->wholesale_id = $request->input('wholesale_id');
            $product->save();
            $sale = new Sale;
            $sale->quantity = 0;
            $sale->saleable_type = 'App\Product';
            $sale->saleable_id = $product->id;
            $sale->save();
        }
        return;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->sales->delete();
        $product->delete();
        Session::flash('deleted_product', 'Pomyślnie usunięto produkt.');
        return;
    }

    public function getProduct($id)
    {
        return $product = Product::findOrFail($id);
    }

    public function createAccessory($request, $id = null)
    {
        if (isset($id)) {
            $accessory = Accessory::findOrFail($id);
            $accessory->name = $request->input('name');
            $accessory->id_wholesale = $request->input('id_wholesale');
            $accessory->quantity = $request->input('quantity');
            $accessory->netto_price = $request->input('netto_price');
            $accessory->brutto_price = $accessory->netto_price + ($accessory->netto_price * 0.23);
            $accessory->price_per_piece = $accessory->netto_price / $accessory->quantity;
            $accessory->in_store = $request->input('in_store');
            $accessory->wholesale_id = $request->input('wholesale_id');
            $accessory->save();
        } else {
            $accessory = new Accessory;
            $accessory->name = $request->input('name');
            $accessory->id_wholesale = $request->input('id_wholesale');
            $accessory->quantity = $request->input('quantity');
            $accessory->netto_price = $request->input('netto_price');
            $accessory->brutto_price = $accessory->netto_price + ($accessory->netto_price * 0.23);
            $accessory->price_per_piece = $accessory->netto_price / $accessory->quantity;
            $accessory->in_store = $request->input('in_store');
            $accessory->wholesale_id = $request->input('wholesale_id');
            $accessory->save();
            $sale = new Sale;
            $sale->quantity = 0;
            $sale->saleable_type = 'App\Accessory';
            $sale->saleable_id = $accessory->id;
            $sale->save();
        }
        return;
    }

    public function deleteAccessory($id)
    {
        $accessory = Accessory::findOrFail($id);
        $accessory->sales->delete();
        $accessory->delete();
        Session::flash('deleted_accessory', 'Pomyślnie usunięto akcesoria.');
        return;
    }

    public function getAccessory($id)
    {
        return $accessory = Accessory::findOrFail($id);
    }

    public function getSoldSets()
    {
        return $sets = Sale::query()->with(['saleable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Set::class
            ]);
        }])->where('saleable_type', 'App\Set')->get();
    }

    public function getSoldSetsStats()
    {
        return $sets = Sale::query()->with(['saleable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Set::class
            ]);
        }])->where('saleable_type', 'App\Set')->orderByDesc('quantity')->limit(10)->get();
    }

    public function sellSet($request, $id)
    {
        $sell = Sale::findOrFail($id);
        $set = Sale::whereHasMorph('saleable', 'App\Set')->where('id', $id)->first();
        if ($set->saleable->in_store < $request->input('quantity')) {
            return Session::flash('no_sets', 'Nie można zrealizować sprzedaży. Za mało zestawów w magazynie: ' . $set->saleable->in_store . ', a chcesz sprzedać: ' . $request->input('quantity'));
        }
        $sell->quantity = $sell->quantity + $request->input('quantity');
        $set->saleable->in_store = $set->saleable->in_store - $request->input('quantity');
        $sell->save();
        $set->saleable->save();
        Session::flash('sold_sets', 'Sprzedaż zrealizowana. Ilość sprzedanych zestawów: ' . $request->input('quantity'));
        return;
    }

    public function returnSet($request, $id)
    {
        $sell = Sale::findOrFail($id);
        $set = Sale::whereHasMorph('saleable', 'App\Set')->where('id', $id)->first();
        if ($set->quantity < $request->input('quantity')) {
            return Session::flash('no_sets', 'Nie można cofnąć sprzedaży. Za mało sprzedanych zestawów: ' . $set->quantity . ', a chcesz cofnąć: ' . $request->input('quantity'));
        }
        $sell->quantity = $sell->quantity - $request->input('quantity');
        $set->saleable->in_store = $set->saleable->in_store + $request->input('quantity');
        $sell->save();
        $set->saleable->save();
        Session::flash('sold_sets', 'Sprzedaż została cofnięta. Ilość cofniętych sprzedaży: ' . $request->input('quantity'));
        return;
    }

    public function getCountedSales()
    {
        $sets = Sale::where('saleable_type', 'App\Set')->get();
        $products = Sale::where('saleable_type', 'App\Product')->get();
        $accessories = Sale::where('saleable_type', 'App\Accessory')->get();
        $sales = [$sets, $products, $accessories];
        return $sales;
    }

    public function getSoldProducts()
    {
        return $products = Sale::query()->with(['saleable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Product::class
            ]);
        }])->where('saleable_type', 'App\Product')->get();
    }

    public function getSoldProductsStats()
    {
        return $sets = Sale::query()->with(['saleable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Product::class
            ]);
        }])->where('saleable_type', 'App\Product')->orderByDesc('quantity')->limit(10)->get();
    }

    public function sellProduct($request, $id)
    {
        $sell = Sale::findOrFail($id);
        $product = Sale::whereHasMorph('saleable', 'App\Product')->where('id', $id)->first();
        if ($product->saleable->in_store < $request->input('quantity')) {
            return Session::flash('no_products', 'Nie można zrealizować sprzedaży. Za mało produktów w magazynie: ' . $product->saleable->in_store . ', a chcesz sprzedać: ' . $request->input('quantity'));
        }
        $sell->quantity = $sell->quantity + $request->input('quantity');
        $product->saleable->in_store = $product->saleable->in_store - $request->input('quantity');
        $sell->save();
        $product->saleable->save();
        Session::flash('sold_products', 'Sprzedaż zrealizowana. Ilość sprzedanych produktów: ' . $request->input('quantity'));
        return;
    }

    public function returnProduct($request, $id)
    {
        $sell = Sale::findOrFail($id);
        $product = Sale::whereHasMorph('saleable', 'App\Product')->where('id', $id)->first();
        if ($product->quantity < $request->input('quantity')) {
            return Session::flash('no_products', 'Nie można cofnąć sprzedaży. Za mało sprzedanych produktów: ' . $product->quantity . ', a chcesz cofnąć: ' . $request->input('quantity'));
        }
        $sell->quantity = $sell->quantity - $request->input('quantity');
        $product->saleable->in_store = $product->saleable->in_store + $request->input('quantity');
        $sell->save();
        $product->saleable->save();
        Session::flash('sold_products', 'Sprzedaż została cofnięta. Ilość cofniętych sprzedaży: ' . $request->input('quantity'));
        return;
    }


    public function getSoldAccessories()
    {
        return $accessories = Sale::query()->with(['saleable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Accessory::class
            ]);
        }])->where('saleable_type', 'App\Accessory')->get();
    }

    public function getSoldAccessoriesStats()
    {
        return $sets = Sale::query()->with(['saleable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Accessory::class
            ]);
        }])->where('saleable_type', 'App\Accessory')->orderByDesc('quantity')->limit(10)->get();
    }

    public function sellAccessory($request, $id)
    {
        $sell = Sale::findOrFail($id);
        $accessory = Sale::whereHasMorph('saleable', 'App\Accessory')->where('id', $id)->first();
        if ($accessory->saleable->in_store < $request->input('quantity')) {
            return Session::flash('no_accessories', 'Nie można zrealizować sprzedaży. Za mało akcesoriów w magazynie: ' . $accessory->saleable->in_store . ', a chcesz sprzedać: ' . $request->input('quantity'));
        }
        $sell->quantity = $sell->quantity + $request->input('quantity');
        $accessory->saleable->in_store = $accessory->saleable->in_store - $request->input('quantity');
        $sell->save();
        $accessory->saleable->save();
        Session::flash('sold_accessories', 'Sprzedaż zrealizowana. Ilość sprzedanych akcesoriów: ' . $request->input('quantity'));
        return;
    }

    public function returnAccessory($request, $id)
    {
        $sell = Sale::findOrFail($id);
        $accessory = Sale::whereHasMorph('saleable', 'App\Accessory')->where('id', $id)->first();
        if ($accessory->quantity < $request->input('quantity')) {
            return Session::flash('no_accessories', 'Nie można cofnąć sprzedaży. Za mało sprzedanych akcesoriów: ' . $accessory->quantity . ', a chcesz cofnąć: ' . $request->input('quantity'));
        }
        $sell->quantity = $sell->quantity - $request->input('quantity');
        $accessory->saleable->in_store = $accessory->saleable->in_store + $request->input('quantity');
        $sell->save();
        $accessory->saleable->save();
        Session::flash('sold_accessories', 'Sprzedaż została cofnięta. Ilość cofniętych sprzedaży: ' . $request->input('quantity'));
        return;
    }


    public function getSearchedSets(string $term)
    {
        return Set::where('name', 'LIKE', '%' . $term . '%')->get();
    }

    public function getSetsResult(string $set)
    {
        return Set::where('name', $set)->get() ?? false;
    }

    public function getSearchedProducts(string $term, $id)
    {
        return Product::where('name', 'LIKE', $term . '%')->where('category_id', $id)->get();
    }

    public function getProductsResult(string $product, $id)
    {
        return Product::where('name', $product)->where('category_id', $id)->get() ?? false;
    }

    public function getSearchedAccessories(string $term)
    {
        return Accessory::where('name', 'LIKE', $term . '%')->get();
    }

    public function getAccessoriesResult(string $product)
    {
        return Accessory::where('name', $product)->get() ?? false;
    }

    public function getSearchedProductsSell(string $term)
    {
        return Product::where('name', 'LIKE', '%' . $term . '%')->get();
    }

    public function getProductsSellResult(string $product)
    {
        return Sale::whereHasMorph('saleable', 'App\Product', function (Builder $query) {
                $query->where('name', 'LIKE', '%' . $_POST['name'] . '%');
            })->get() ?? false;
    }

    public function getSearchedSetsSell(string $term)
    {
        return Set::where('name', 'LIKE', '%' . $term . '%')->get();
    }

    public function getSetsSellResult(string $set)
    {
        return Sale::whereHasMorph('saleable', 'App\Set', function (Builder $query) {
                $query->where('name', 'LIKE', '%' . $_POST['name'] . '%');
            })->get() ?? false;
    }

    public function getSearchedAccessoriesSell(string $term)
    {
        return Accessory::where('name', 'LIKE', '%' . $term . '%')->get();
    }

    public function getAccessoriesSellResult(string $accessory)
    {
        return Sale::whereHasMorph('saleable', 'App\Accessory', function (Builder $query) {
                $query->where('name', 'LIKE', '%' . $_POST['name'] . '%');
            })->get() ?? false;
    }

    public function getSearchedNotes(string $term) {
        return Note::where('name', 'LIKE', '%'.$term.'%')->get();
    }

    public function getNotesResult(string $note) {
        return Note::where('name', 'LIKE', '%'.$note.'%')->paginate(28) ?? false;
    }

    public function updateUser($request) {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return;
    }
}
