<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Constants\Db\Account\DbTableAccountAuth;
use App\Utilities\Crypto;
use App\Utilities\Hash;

class AccountAuthSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $account_auth_id = '00000l5b06ixcqjoko0deoh7c10bw74';
        $account_id = '00000l59q5fckcv53bm1w0z9vda4vbd';
        $created_at = new Carbon('2022-05-31 15:04:05');
        $registered_at = new Carbon('2022-05-31 22:53:05');
        $account_email = 'kurachiweb@gmail.com';
        $account_password = 'pass1kanazaWa';

        $account_auth1 = [
            DbTableAccountAuth::ID => $account_auth_id,
            DbTableAccountAuth::ACCOUNT_ID => $account_id,
            DbTableAccountAuth::EMAIL => Crypto::toEncryptString($account_email),
            DbTableAccountAuth::EMAIL_HASH => Hash::toHashString($account_email),
            DbTableAccountAuth::EMAIL_ALTER => Crypto::toEncryptString(null),
            DbTableAccountAuth::MOBILE_NO => Crypto::toEncryptString('+81-9012345678'),
            DbTableAccountAuth::VERIFIED_EMAIL => 0,
            DbTableAccountAuth::VERIFIED_MOBILE_NO => 0,
            DbTableAccountAuth::PASSWORD => Hash::toHashPassword($account_password),
            DbTableAccountAuth::PASSWORD_UPDATED_AT => $created_at,
            DbTableAccountAuth::BILLING_TOKEN => null,
            DbTableAccountAuth::CREATED_AT => $created_at,
            DbTableAccountAuth::UPDATED_AT => $registered_at,
            DbTableAccountAuth::DELETED_AT => null,
        ];

        $account_auth_id = '00000l5b081y9j3i33h9xhong5nawqr';
        $account_id = '00000l5b06s9zm6oi65p5cy4lcdu1ey';
        $created_at = new Carbon('2043-07-01 03:34:10');
        $registered_at = new Carbon('2043-07-01 03:34:10');
        // ダブルクオーテーションで囲むなら、local-part全体を囲まなければならない。
        // ピリオドlocal-partでは先頭末尾以外に使える。ダブルクオーテーションで囲めば連続使用もできる。
        // RFC準拠の最大長さ、local-partの長さ64文字、全体で254文字。
        $account_email = '"!#$%&\'*+-/=?^_{|.}~..ss()*,:;<>@[]ga\a\A\0\!\.`\\"\ \	nantonanntnantonan"@antonanntnantonan-antonantonantonanto-antonannt.antonanntnantonan-antonanntnantonan-ntonannton-antonanntnantonan.example-antonanntnantonan-antonanntnantonan-antonanntnantonan-a.org';
        $account_email_alter = '"!#$%&\'*+-/=?^_{|.}~..ss()*,:;<>@[]ga\a\A\0\!\.`\\"\ \	nantonanntnantonan"@antonanntnantonan-antonantonantonanto-antonannt.antonanntnantonan-antonanntnantonan-onantnnton-antonanntnantonan.example-antonanntnantonan-antonanntnantonan-antonanntnantonan-a.org';
        // 2000文字の英数大文字小文字記号入りパスワード
        $account_password = 'c9GE/Q#6pZ6n#&~SASSrvwR_*(CfKW7)%tGNPA,L%biv-ZL#GgWrH7z_cuirCK7J$XfJ#U6i&3f~XyF,)ZhS(nuQ-qjx&)Arc+/MKf.B(4)8s)RsMM64RF+$y_KF)W5wPUwsHQ2(8R(NRECU,)fv4A8Kf88%xmN%w*77x)DMcWa8g,ADKL#JxbNAQJb*~LbB*.8c(vS|npT(T+~~Q+8ESYm(A|h/zsa6dzLiM3XTk$AQb%&iP$xgD-|V+e,ZyPRQae-ueV|5L6!UvB8ck!J.#~L|fRuGsz~7v6!tQA*)a|,,4DNF9vE35A(-kGbv$bsSU+#k)E+nPY#._(q8acTW5Mg+m/8MAx3mkC7iXAPM2!JE4_S.3UNdZ5)siB_XwuYtc5L2c7zJMGnYr3UVEDcUd9SnPL/+cNAgXM9*LT7Dv36pHqQ*WVtjMHPb#iTqcRu3|$(dd6jY$e-EH(79v42TZ!AV87v4,3-b(4Q85V5cVBB~veTQsqZRt2%Rf3fRN!wQb3t4794$Lx8zb7iud-cU5AQ7/PCYY&bg-)Vhit!S6.3zEFBKdT5YA7xSyt.mJwx4RHtxDKK_md&asv4C!V$#nZw,(K35T_)i)DNb*xsSW(cP5JhwhDB+QXTeZ~P3Z,9SJ~7avV#(u.d+Rejt5S2kfM~#*V7dwFdj_*z|&R6q+q/xv4|YPfu!/C*w/J%*Q27wzu+Bh,mg*V.i7LQ/yKuagHh)uaYK3nJ8rFQwt6m~x,DS,dEP5bFdaTPeWpaNUWGRU|ywP/XcKsni-R!K9AsWYrFCA3~*-$L(b_6MEXLLwWwqtC)7jaK|Pj&Bm94U8nXFn/YdNdXLQEx!jWD)/.N/2W+$wJ~!E3pVZCzcVF5qTEuuh2B/ktQGWrPyKM(Rb+CS(AkbS++8jCS(J_6ZyQ6_i_P63PL.jD5p_*e)Tw~Yas,5QmPD$jKA2R8rDeuqTZ*GHK#LDcF$xhYym!xy9|8Ki__U+ew$uG_#(Mu.M&*%dT|3wjEMeGv4R//.VcRsnK|cNg#bxN5Z3ei5*&e_sirvf3V_6YCj~L/jJMaRjXdq~69JFfU4sc9cZ2ENh+|ircJNn9gBVS*wV)v#Ve$AX43_K(JWS8*vdHE|cPCWJgv4afj~df&u3MX4rT.2vqa%B|v#|&fEyTh6bw,MT7tJKKZnQFMR#Rw$ZTCDYuGRiyXXFD&kvFzWT(5XYm(ijC8acY&,gzCkB&bP*+5hUhASk*b+deXD-gZVTEuR(_b5tpjUfrnRrV,G(npS_ThjZJrZ3A734m644ek_R(pi3v4E$H*hBa.j926B|Xbqg-rXq2V&z.awVLY*Miuk2gqn~a(8QgCjE3ZydQG4G!VV/HR*Q)EdMUdsgAyWdsxuT_vvREykk-E63pYZ,njhCR_2#6ZYgHg+tB(323Pw3fMjXY#%H3$(w3u.9sF#qfa)3a9e/&)vSxc3Cdx5BSiF4.prZFR8Qen/SMwSYScjyKQ%((M(WyXv#Z$-dwc,i9DGZtnJJx_-&%!f)ZRGys9P.iMQg6%yeALw4G%U%f-9ASC(pBTv23Q~*/Q)LjtgMTnq#,SqkYaNZyJe!mc~,guXk$k,NutUic4#nKavY4RTp6#hJ-kwW4&m#Dm3aZ_!!(PvRR*mTwrf7wMJUXxAXcpU+9Mwv6bdZnZ8hR$%5,(8V+P,&Sb2/Lss9v2uPFdDUqr3nVndsF&iuxZVKMpNfd#jzK&ijV7J8tQyFeCn%r8v4HaArQyB365AwUJWypbBW|dJCb2)Zj*#7H8#Rip/P&fWehMw*,pf|NDxczhvm#96fDi,mv4N$LdnAsv4!YLfZ#a7v4)Yev3UNakY.&gUn_xLChkD2njN&Ht|K8BZk3tuY)%fgAYJu./P8._L~!$N~#-G$W+/WkksB!M|Dq+rSN|p+harxCyMn1x#w89K$GNjj~kajcgvgz|KxsH,/xpP,nz,hVBhsiG5q,nM3V,PeLamf6UYK82|rnwBt*DVRp5bv4m2g6~7';

        $account_auth2 = [
            DbTableAccountAuth::ID => $account_auth_id,
            DbTableAccountAuth::ACCOUNT_ID => $account_id,
            DbTableAccountAuth::EMAIL => Crypto::toEncryptString($account_email),
            DbTableAccountAuth::EMAIL_HASH => Hash::toHashString($account_email),
            DbTableAccountAuth::EMAIL_ALTER =>  Crypto::toEncryptString($account_email_alter),
            // +1 アメリカ合衆国
            DbTableAccountAuth::MOBILE_NO => Crypto::toEncryptString('+1-90123452678'),
            DbTableAccountAuth::VERIFIED_EMAIL => 0,
            DbTableAccountAuth::VERIFIED_MOBILE_NO => 0,
            DbTableAccountAuth::PASSWORD => Hash::toHashPassword($account_password),
            DbTableAccountAuth::PASSWORD_UPDATED_AT => $created_at,
            DbTableAccountAuth::BILLING_TOKEN => null,
            DbTableAccountAuth::CREATED_AT => $created_at,
            DbTableAccountAuth::UPDATED_AT => $registered_at,
            DbTableAccountAuth::DELETED_AT => null,
        ];

        DB::table('account_auth')->insert([$account_auth1, $account_auth2]);
    }
}
