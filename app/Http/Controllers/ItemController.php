<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    // we only making basic get/create/update/delete
    // notice that using auto injection will sometimes 
    // cause resource not found exception 
    // handle that in exception handler

    /**
     * Get all the Items
     * 
     * @return collections of items
     */
    public function all() {
        return Item::all();
    }

    /**
     * Get one item, used type-hint and auto injection in route
     * 
     * @return Object
     */
    public function get($id) {
        return Item::find($id);
    }

    public function getCate($category) {
        return Item::where('category', $category)->get();   
    }

    // Be cautious about update and insert, check out the request

    /**
     * Update the item.
     * Note that the item in the parameter has already injected by 
     * the framework
     * 
     * @return the updated object and status code 200
     */
    public function update(Request $req, Item $item) {
        $item->update($req->all());

        return response()->json($item, 200);
    }

    public function create(Request $req) {
        $item = Item::create($req->all());

        return response()->json($item, 201);
    }

    public function delete(Item $item) {
        $item->delete();

        return response()->json(null, 204);
    }

}
