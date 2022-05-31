<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountEmailVerify extends Mailable {
    use Queueable, SerializesModels;

    /** メール認証トークン */
    public $token;

    /**
     * メール送信初期化
     *
     * @return void
     */
    public function __construct(string $token) {
        $this->token = $token;
    }

    /**
     * メール送信
     *
     * @return $this
     */
    public function build() {
        $origin = config('app.origin_front');
        $url = "$origin/?email_token=$this->token";

        return $this->from('kurachiweb@gmail.com') // 送信元
            ->subject('アカウントのメールアドレスを認証する') // 件名
            ->view('mail.account.verify-email') // メールテンプレートの指定
            ->with(['url' => $url]); // テンプレートへ変数を渡す
    }
}
