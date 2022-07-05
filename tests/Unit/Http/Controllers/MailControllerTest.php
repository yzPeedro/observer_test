<?php

namespace Http\Controllers;

use App\Http\Controllers\MailController;
use App\Models\Mail;
use Tests\TestCase;

class MailControllerTest extends TestCase
{
    public function testUserCannotSetInvalidEmail()
    {
        $params = [
            'to' => 'email.test',
            'from' => 'email.test',
            'content' => '...',
            'subject' => '...'
        ];

        $request = $this->post('/api/send_mail', $params);

        $request->assertStatus(302);
    }

    public function testUserCannotSendEmailForEquals()
    {
        $params = [
            'to' => 'email@test.com',
            'from' => 'email@test.com',
            'content' => '...',
            'subject' => '...'
        ];

        $request = $this->post('/api/send_mail', $params);

        $request->assertStatus(400);
    }

    public function testSendMail()
    {
        $params = [
            'to' => 'admin@test.com',
            'from' => 'test@test.com',
            'content' => '...',
            'subject' => '...'
        ];

        $request = $this->post('/api/send_mail', $params);

        $email = json_decode($request->baseResponse->content());

        Mail::where('id', $email->data->item->id)->delete();

        $request->assertJsonStructure([
           'error',
           'status',
           'data' => ['message', 'item']
        ]);

    }
}
