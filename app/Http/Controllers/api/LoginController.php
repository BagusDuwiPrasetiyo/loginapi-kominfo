<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $check = DB::table('data_pegawai')->where('nip', $request->nip);

        if ($check->count() == 0) {
            $resp = [
                'metadata' => [
                    'code' => 400,
                    'status' => ''
                ]
            ];

            return response()->json($resp);
        }

        if (!$check->get()[0]->password == Crypt::encrypt($request->password)) {
            $resp = [
                'metadata' => [
                    'code' => 400,
                    'status' => ''
                ]
            ];

            return response()->json($resp);
        }

        $resp = [
            'metadata' => [
                'code' => 200,
                'status' => ''
            ]
        ];

        return response()->json($resp);
    }
}
