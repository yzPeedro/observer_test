<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MailRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function __construct(private MailRepository $repository){}

    public function send(Request $request): JsonResponse
    {
        $request->validate([
            'to' => 'required|email',
            'from' => 'required|email',
            'content' => 'required',
            'subject' => 'required',
        ]);

        try {
            return response()->json([
               'error' => false,
               'status' => 200,
               'data' => [
                   'message' => 'Ok',
                   'item' => $this->repository->sendMail($request->all())
               ]
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error' => true,
                'status' => $exception->getCode(),
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], $exception->getCode());
        }
    }
}
