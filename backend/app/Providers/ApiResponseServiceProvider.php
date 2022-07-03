<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

/**
 * レスポンス形式を定義する
 */
class ApiResponseServiceProvider extends ServiceProvider {
    public function boot() {
        /**
         * レスポンス規格統一
         *
         * @param array|null $data
         * @param int $status_code
         * @param array $headers
         * @param string $message
         * @return \Illuminate\Http\Response
         */
        function unifiedResponse($data, $status_code, $headers, $message) {
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $status_code, $headers, JSON_UNESCAPED_UNICODE);
        }

        // 処理が成功した場合のレスポンス
        Response::macro(
            'success',
            function ($data = null, $message = 'Successful.', $headers = []) {
                return unifiedResponse($data, HttpResponse::HTTP_OK, $headers, $message);
            }
        );

        // 作成処理が成功した場合のレスポンス
        Response::macro(
            'successCreate',
            function ($data = null, $message = 'Successful.', $headers = []) {
                return unifiedResponse($data, HttpResponse::HTTP_CREATED, $headers, $message);
            }
        );

        // リソースが見つからなかった場合のレスポンス
        Response::macro(
            'notFound',
            function ($data = null, $message = 'Not found.', $headers = []) {
                return unifiedResponse($data, HttpResponse::HTTP_NOT_FOUND, $headers, $message);
            }
        );

        // リクエストに処理上の問題があった場合のレスポンス
        Response::macro(
            'badRequest',
            function ($data = null, $message = 'Bad Request.', $headers = []) {
                return unifiedResponse($data, HttpResponse::HTTP_BAD_REQUEST, $headers, $message);
            }
        );

        // 何らかのエラーが発生した場合のレスポンス
        Response::macro(
            'otherError',
            function ($data = null, $status_code = HttpResponse::HTTP_BAD_REQUEST, $message = 'Error.', $headers = []) {
                return unifiedResponse($data, $status_code, $headers, $message);
            }
        );
    }
}
