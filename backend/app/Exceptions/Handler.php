<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $status_code = 0;
        $error_message = '';

        // リクエスト・処理のエラー種類によりレスポンスを変える
        $status_code = $exception->getStatusCode();
        switch ($status_code) {
            case Response::HTTP_UNAUTHORIZED:
                $error_message = 'Unauthorized.';
                break;
            case Response::HTTP_FORBIDDEN:
                $error_message = 'Forbiddden.';
                break;
            case Response::HTTP_NOT_FOUND:
                $error_message = 'Not Found.';
                break;
            case Response::HTTP_METHOD_NOT_ALLOWED:
                $error_message = 'Method not allowed.';
                break;
            case Response::HTTP_TOO_MANY_REQUESTS:
                $error_message = 'Too Many Requests.';
                break;
            case Response::HTTP_INTERNAL_SERVER_ERROR:
                $error_message = 'Server Error.';
                break;
            case Response::HTTP_SERVICE_UNAVAILABLE:
                $error_message = 'Service Unavailable.';
                break;
            default:
                // その他のエラー
                $status_code = Response::HTTP_BAD_REQUEST;
                $error_message = $exception->getMessage();
        }

        return response()->otherError(null, $error_message, $status_code, [
            'Content-Type' => 'application/problem+json'
        ]);
    }
}
