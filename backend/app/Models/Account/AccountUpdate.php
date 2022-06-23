<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Models\Account\Account as AcconutModel;

/** アカウント基本情報：更新用 */
class AccountUpdate extends AcconutModel {
    /**
     * 追加できる列
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'display_id',
        'name',
        'tel_no',
        'address',
        'address_bill'
    ];
}
