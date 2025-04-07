<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ParserService;
use Illuminate\Support\Facades\Cache;
use PHPHtmlParser\Dom;

class ParserServiceTest extends TestCase
{
    public function test_index_returns_cached_data_if_exists()
    {
        $cachedData = [
            [
                'name' => 'Test Channel 1',
                'subscribers' => '1000',
                'time' => '1 hour ago',
                'progressbar' => '<div class="progress-bar" style="width: 50%"></div>',
                'avatarLink' => 'https://example.com/avatar1.jpg',
                'progressbarPecent' => '50',
            ]
        ];
    
        Cache::shouldReceive('get')
            ->once()
            ->with('channel_data')
            ->andReturn($cachedData);
    
        $parserService = new ParserService();
        $result = $parserService->index();
    
        $this->assertEquals($cachedData, $result);
    }

    public function test_index_parses_data_successfully()
    {
        $domMock = $this->createMock(Dom::class);
        $domMock->method('loadFromUrl')
            ->willReturnSelf();

        $parserService = new ParserService();
        $result = $parserService->index();

        $this->assertNotEmpty($result);
        
        $this->assertArrayHasKey('name', $result[0]);
        $this->assertNotEmpty($result[0]['name']);
    }

    public function test_index_returns_empty_array_on_error()
    {
        $domMock = $this->createMock(Dom::class);
        $domMock->expects($this->once())
            ->method('loadFromUrl')
            ->will($this->throwException(new \Exception('Error loading URL')));

        $parserService = new ParserService($domMock);
        $result = $parserService->index();

        $this->assertEmpty($result);
    }
}
