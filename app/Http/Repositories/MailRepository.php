<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Str;

class MailRepository extends MailAbstract
{
    /**
     * @throws Exception
     */
    public function sendMail(array $data)
    {
        if ($data['from'] === $data['to']) {
            throw new Exception('Error: FROM and TO parameters are equals', 400);
        }

        $data['id'] = Str::uuid();

        try {
            return $this->save($data);
        } catch (Exception $exception) {
            throw new Exception('Error: '. $exception->getMessage(), 500);
        }
    }
}
