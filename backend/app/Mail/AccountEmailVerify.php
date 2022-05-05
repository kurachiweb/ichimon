<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountEmailVerify extends Mailable {
    use Queueable, SerializesModels;

    /** メール本文 */
    public $content;

    /**
     * メール送信初期化
     *
     * @return void
     */
    public function __construct(string $content) {
        $this->content = $content;
    }

    /**
     * メール送信
     *
     * @return $this
     */
    public function build() {
        return $this->from('kurachiweb@gmail.com') // 送信元
            ->subject('アカウントのメールアドレスを認証する') // 件名
            ->view('mail.account.verify-email') // メールテンプレートの指定
            ->with(['content' => $this->content]); // テンプレートへ変数を渡す
    }
}
