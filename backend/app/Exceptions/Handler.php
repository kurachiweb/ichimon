<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * エラー時の動作をオーバーライドするコールバック関数まとめ
     *
     * @return void
     */
    public function register() {
        $this->renderable(function (HttpException $exception, Request $request) {
            // APIの処理中に何らかのエラーがあれば、JSONを返す
            if ($request->is('api/*')) {
                return $this->createApiErrorResponse($exception);
            }
        });
    }

    /**
     * エラーにもとづき、HTTPステータスコードとメッセージを返す
     *
     * @param \Symfony\Component\HttpKernel\Exception\HttpException $exception
     * @return \Illuminate\Http\Response
     */
    private function createApiErrorResponse(HttpException $exception) {
        $status = 0;
        $errorMessage = '';

        if ($this->isHttpException($exception)) {
            // リクエスト・処理のエラー種類によりレスポンスを変える
            $status = $exception->getStatusCode();
            switch ($status) {
                case 401:
                    $errorMessage = 'Unauthorized';
                    break;
                case 403:
                    $errorMessage = $exception->getMessage() ?: 'Forbiddden';
                    break;
                case 404:
                    $errorMessage = 'Not Found';
                    break;
                case 419:
                    $errorMessage = 'Page Expired';
                    break;
                case 429:
                    $errorMessage = 'Too Many Requests';
                    break;
                case 500:
                    $errorMessage = 'Server Error';
                    break;
                case 503:
                    $errorMessage = 'Service Unavailable';
                    break;
                default:
                    // その他のエラー
                    $status = 400;
                    $errorMessage = $exception->getMessage();
            }
        }

        return response()->json([
            'message' => $errorMessage
        ], $status, [
            'Content-Type' => 'application/problem+json'
        ]);
    }
}
