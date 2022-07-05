<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\MailContract;
use App\Models\Mail;

class MailAbstract implements MailContract
{
    public function save(array $data)
    {
        return Mail::create($data);
    }
}
