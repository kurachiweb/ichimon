<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAuth;
use App\Constants\ConstClient;

class UserController extends Controller {
    /**
     * 一覧取得
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
     * 1人作成
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
        $user = $user->toArray();
        $user['auth'] = $user_auth->toArray();
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'user' => $user,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 1人取得
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);
        if ($user) {
            $user_auth = $user->auth;
            $user = $user->toArray();
            $user['auth'] = $user_auth;
            return response()->json([
                'message' => 'Successful',
                'data' => [
                    'user' => $user
                ]
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * 1人更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bigint  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // リクエストに含まれている場合のみ更新対象とする
        $user_update = [];
        if (isset($request->display_id)) $user_update['display_id'] = $request->display_id;
        if (isset($request->name)) $user_update['name'] = $request->name;
        if (isset($request->tel_no)) $user_update['tel_no'] = $request->tel_no;
        if (isset($request->address)) $user_update['address'] = $request->address;
        if (isset($request->address_bill)) $user_update['address_bill'] = $request->address_bill;

        $user = User::where('id', $id)->update($user_update);
        if ($user) {
            return response()->json([
                'message' => 'Successful',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
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
