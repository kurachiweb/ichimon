<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAuth;
use App\Constants\ConstClient;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = User::all(["id", "display_id", "name", "registered_at"]);
        return response()->json([
            'message' => 'Successful',
            'data' => $user
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $body = $request->getContent();
        $req = json_decode($body, true);

        $now = new DateTime();
        $user_id = gmp_intval(gmp_random_range(1, ConstClient::JS_MAX_SAFE_INTEGER));
        $user_auth_id = gmp_intval(gmp_random_range(1, ConstClient::JS_MAX_SAFE_INTEGER));

        // ユーザーデータのカラム値列上書き
        $user = $req;
        $user['id'] = $user_id;
        $user['registered_at'] = $now;
        if (isset($user['password'])) {
            $user['password_updated_at'] = $now;
        }

        // ユーザー認証データのカラム値列上書き
        $user_auth = $req;
        $user_auth['id'] = $user_auth_id;
        $user_auth['user_id'] = $user['id'];
        $user_auth['email_hash'] = hash('sha3-512', $user_auth['email']);

        $user = User::create($user);
        $user_auth = UserAuth::create($user_auth);
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'user' => $user,
                'user_auth' => $user_auth,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
