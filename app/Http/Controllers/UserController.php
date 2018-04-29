<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function all() {
        return User::all();
    }

    public function get($id) {
        return User::find($id);
    }

    public function update(Request $req, User $user) {
        $user->update($req->all());

        return response()->json($user, 200);
    }

    public function create(Request $req) {
        // $user = User::create($req->all());
        $user = new User;
        $user->name = $req->name;
        $user->password = hash('md5', $req->password);
        $user->phone_number = $req->phone_number;
        $user->address = $req->address;
        $user->occupation = $req->occupation;
        $user->role = 1;
        $user->email = $req->email;
        $user->save();
        // if (!$req->hasFile('file')) {
        //     Log::debug('user create function receive no file!');

        //     return response()->json([
        //         'error' => 'no file field'
        //     ], 201);
        // }

        // $vali = Validator::make($req->all(), [
        //     'file' => 'required | mimes:jpeg,jpg,png',
        // ]);

        // if ($vali->fails()) {
        //     Log::debug('user create function receiving not a photo');
        //     return response()->json([
        //         'error' => 'not a photo'
        //     ], 201);
        // }

        // $f = $req->file;
        // $ext = $f->guessExtension();
        // $filename = uniqid("", true).".$ext";
        // // store it in photo disk
        // Log::debug('filename: '.$filename);
        // $f->storeAs('/', $filename, 'image');

        // $user->photo_url = Storage::disk('image')->url($filename);

        // $user->save();
        return response()->json($user, 201);
    }

    public function delete(User $user) {
        $user->delete();

        return response()->json(null, 204);
    }

    // upload photo and generate the url for the photo
    // $req for current request
    // $user is inject by laravel framework
    public function uploadPhoto(Request $req, User $user) {
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

        $user->photo_url = Storage::disk('image')->url($filename);

        $user->save();
        return response()->json([
            'success' => true,
            'url' => Storage::disk('image')->url($filename),
        ], 200);
    }

    // should have email and password 
    // in the request body
    public function login(Request $req) {
        $user = User::where('email', $req->input('email'))->first();
        if (is_null($user) || hash('md5', $req->input('password')) !== $user->password) {
            return response()->json(['Email and password not match' => true], 400);
        } 

        $token = bin2hex(random_bytes(16));     // generate random hash token

        $user->token = $token;
        $user->token_time = date('Y-m-d H:i:s');
        $user->save();

        return response()->json([
            'token' => $token,
            'id' => $user->id
        ], 200);
    }
}
