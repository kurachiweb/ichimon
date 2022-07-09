<?php

declare(strict_types=1);

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MasterGetController extends Controller {
    /**
     * サービス全体に関わるマスタ情報を取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        /**
         * マスタデータ
         *
         * @var array<string, array<int, array<string, mixed>>>
         */
        $masters = [];

        $masters['sexes'] = [
            ['id' => 1, 'value' => '男性'],
            ['id' => 2, 'value' => '女性'],
            ['id' => 2, 'value' => 'その他'],
            ['id' => 2, 'value' => '回答しない']
        ];

        return response()->success(['masters' => $masters]);
    }
}
