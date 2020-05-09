<?php

namespace App\Interfaces;

interface RepositoryInterface {
    public function getWholesales();
    public function getWholesale($id);
    public function getAccessories();
    public function getNotes();
    public function getSets();
    public function getSet($id);
    public function createNote($request, $id=null);
    public function getNote($id);
    public function deleteNote($id);
    public function createWholesale($request, $id=null);
    public function deleteWholesale($id);
    public function createSet($request, $id=null);
    public function deleteSet($id);
    public function setStore($request, $id);
    public function getCategories();
    public function getProducts($id);
    public function createCategory($request, $id=null);
    public function deleteCategory($id);
    public function getCategory($id);
    public function createProduct($request, $id=null);
    public function deleteProduct($id);
    public function getProduct($id);
    public function createAccessory($request, $id=null);
    public function deleteAccessory($id);
    public function getAccessory($id);
    public function getSoldSets();
    public function sellSet($request, $id);
    public function getCountedSales();
    public function getSoldProducts();
    public function sellProduct($request, $id);
    public function getSoldAccessories();
    public function sellAccessory($request, $id);
    public function getSearchedSets(string $term);
    public function getSetsResult(string $set);
    public function getSearchedProducts(string $term, $id);
    public function getProductsResult(string $product, $id);
    public function getSearchedAccessories(string $term);
    public function getAccessoriesResult(string $accessory);
    public function getSearchedProductsSell(string $term);
    public function getProductsSellResult(string $product);
    public function getSearchedSetsSell(string $term);
    public function getSetsSellResult(string $set);
    public function getSearchedAccessoriesSell(string $term);
    public function getAccessoriesSellResult(string $accessory);
    public function getSearchedNotes(string $term);
    public function getNotesResult(string $note);
    public function returnSet($request, $id);
    public function returnProduct($request, $id);
    public function returnAccessory($request, $id);
    public function getSoldSetsStats();
    public function getSoldProductsStats();
    public function getSoldAccessoriesStats();
}
