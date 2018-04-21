<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // we only making basic get/create/update/delete
    // notice that using auto injection will sometimes 
    // cause resource not found exception 
    // handle that in exception handler

    public function all() {
        return Item::all();
    }

    public function get($id) {
        return Item::find($id);
    }

    public function getCate($category) {
        return Item::where('category', $category)->where('status', 0)->get();   
    }

    public function getUser($user_id) {
        return Item::where('user_id', $user_id)->get();
    }

    public function getStatus($status) {
        return Item::where('status', $status)->get();
    }

    public function getSold($user_id) {
        $trans = Transaction::where('seller_id', $user_id)->with('item')->get();

        $arr = array();
        foreach ($trans as $t) {
            $arr[] = $t->item;
        }
        
        return response()->json($arr, 201);
    }

    public function getBought($user_id) {
        $trans = Transaction::where('buyer_id', $user_id)->with('item')->get();

        $arr = array();
        foreach ($trans as $t) {
            $arr[] = $t->item;
        }
        
        return response()->json($arr, 201);
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
        if (!$req->hasFile('file')) {
            Log::debug('no file!');

            return response()->json([
                'error' => 'no file field'
            ], 201);
        }

        $vali = Validator::make($req->all(), [
            'file' => 'required | mimes:jpeg,jpg,png',
        ]);

        if ($vali->fails()) {
            Log::debug('receiving not a photo');
            return response()->json([
                'error' => 'not a photo'
            ], 201);
        }

        $f = $req->file;
        $ext = $f->guessExtension();
        $filename = uniqid("", true).".$ext";
        // store it in photo disk
        Log::debug('filename: '.$filename);
        $f->storeAs('/', $filename, 'image');

        $item->photo_url = Storage::disk('image')->url($filename);

        $item->save();
        return response()->json([
            'success' => true,
            'url' => Storage::disk('image')->url($filename),
        ], 201);
    }

    public function delete(Item $item) {
        $item->delete();

        return response()->json(null, 204);
    }

    // upload photo and generate the url for the photo
    // $req for current request
    // $item is inject by laravel framework
    public function uploadPhoto(Request $req, Item $item) {
        // this will be unique normally
        if (!$req->hasFile('file')) {
            Log::debug('no file!');
            return response()->json([
                'error' => 'no file field'
            ], 400);
        }

        $vali = Validator::make($req->all(), [
            'file' => 'required | mimes:jpeg,jpg,png',
        ]);

        if ($vali->fails()) {
            Log::debug('receiving not a photo');
            return response()->json([
                'error' => 'not a photo'
            ], 400);
        }

        $f = $req->file;
        $ext = $f->guessExtension();
        $filename = uniqid("", true).".$ext";
        // store it in photo disk
        Log::debug('filename: '.$filename);
        $f->storeAs('/', $filename, 'image');

        $item->photo_url = Storage::disk('image')->url($filename);

        $item->save();
        return response()->json([
            'success' => true,
            'url' => Storage::disk('image')->url($filename),
        ], 200);
    }
}
