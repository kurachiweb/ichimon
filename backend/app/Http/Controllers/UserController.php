<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAuth;
use App\Utilities\RandomNumber;

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
        $_RandomNumber = new RandomNumber();
        $body = $request->getContent();
        $req = json_decode($body, true);
        $req_user = $req;

        $user = User::getDefault(true);

        $now = new DateTime();
        $user_id = $_RandomNumber->dbTableId();
        $user_auth_id = $_RandomNumber->dbTableId();

        // ユーザー基本情報をリクエスト内容で上書き
        $user['id'] = $user_id;
        $user['display_id'] = $req_user['display_id'];
        $user['registered_at'] = $now;
        $user['password_updated_at'] = $now;

        // ユーザー認証情報をリクエスト内容で上書き
        $user['auth']['id'] = $user_auth_id;
        $user['auth']['user_id'] = $user_id;
        $user['auth']['email'] = $req_user['auth']['email'];
        $user['auth']['email_hash'] = $req_user['auth']['email'];
        $user['auth']['password'] = $req_user['auth']['password'];

        $res_user = User::create($user);
        $res_user_auth = UserAuth::create($user['auth']);
        $res_user = $res_user->toArray();
        $res_user['auth'] = $res_user_auth->toArray();
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'user' => $res_user,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);
        if (!isset($user)) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        // リクエストに含まれている場合のみ上書きする
        if (isset($request->display_id)) $user['display_id'] = $request->display_id;
        if (isset($request->name)) $user['name'] = $request->name;
        if (isset($request->tel_no)) $user['tel_no'] = $request->tel_no;
        if (isset($request->address)) $user['address'] = $request->address;
        if (isset($request->address_bill)) $user['address_bill'] = $request->address_bill;

        $success = $user->save();
        if ($success) {
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
     * 1人削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        if (!isset($user)) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
        $user_auth = $user->auth;
        if (!isset($user_auth)) {
            return response()->json([
                'message' => 'sNot found',
            ], 404);
        }
        $user_auth->delete();
        $user->delete();
        return response()->json([
            'message' => 'Successful',
        ], 200);
    }
}
