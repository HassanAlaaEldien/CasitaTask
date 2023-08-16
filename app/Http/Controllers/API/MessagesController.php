<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Responses\ResponsesInterface;
use App\Services\JsonFormatter;
use Illuminate\Contracts\View\View;

class MessagesController extends Controller
{
    /**
     * @var ResponsesInterface $responder
     */
    protected ResponsesInterface $responder;

    /**
     * MapsController constructor.
     * @param ResponsesInterface $responder
     */
    public function __construct(ResponsesInterface $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @return View
     */
    public function index()
    {
        $jsonFormatter = new JsonFormatter(storage_path("json_formatter.txt"));

        return $this->responder->respond(['data' => ['messages' => $jsonFormatter->getMessages()]]);
    }
}
