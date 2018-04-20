<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;

class TransactionController extends Controller
{
    //
    public function all() {
        return Transaction::all();
    }

    public function get($id) {
        return Transaction::find($id);
    }

    public function update(Request $req, Transaction $trans) {
        $trans->update($req->all());

        return response()->json($trans, 200);
    }

    public function create(Request $req) {
        $trans = Transaction::create($req->all());
        return response()->json($trans, 201);
    }


    public function delete(Transaction $trans) {
        $trans->delete();
        return response()->json(null, 204);
    }
}
