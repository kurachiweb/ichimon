<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountEmailVerify extends Mailable {
    use Queueable, SerializesModels;

    /** メール認証トークン */
    public string $verify_token;

    /**
     * メール送信初期化
     */
    public function __construct(string $verify_token) {
        $this->verify_token = $verify_token;
    }

    /**
     * メール送信
     *
     * @return $this
     */
    public function build() {
        $origin = config('app.origin_front');
        $url = "$origin/?email_token=$this->verify_token";

        return $this->from('kurachiweb@gmail.com') // 送信元
            ->subject('アカウントのメールアドレスを認証する') // 件名
            ->view('mail.account.verify-email') // メールテンプレートの指定
            ->with(['url' => $url]); // テンプレートへ変数を渡す
    }
}
