<?php

namespace App\Http\Controllers;

use App\Services\ParserService;

class ParserController extends Controller
{
    private ParserService $parserService;
    public function __construct(ParserService $parserService)
    {
        $this->parserService = $parserService;
    }

    public function __invoke()
    {
        $collection = $this->parserService->index();
        return view('index', compact('collection'));
    }
}
