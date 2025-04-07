<?php

namespace App\Services;

use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ParserService
{
    protected $dom;

    public function __construct(Dom $dom = null)
    {
        $this->dom = $dom ?? new Dom();
    }

    public function index()
    {
        $cachedData = Cache::get('channel_data');
        if ($cachedData) return $cachedData;

        try {
            $this->dom->loadFromUrl('https://www.twitchmetrics.net/channels/follower');
        } 
        catch (\Exception $e) {
            Log::error('Помилка при парсингу даних: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            return [];
        }

        $result = $this->dom->find('.list-group .list-group-item');
        $listItems = [];

        foreach ($result as $item) {
            $name = $item->find('h5')->text;
            $subscribers = $item->find('samp')->text;
            $timeAgo = $item->find('time')->text;
            $progressbar = $item->find('.progress-bar');
            $avatar = $item->find('img');

            $avatarLink = $avatar->getAttribute('src');
            preg_match('/\d+/', $progressbar->getAttribute('style'), $progressbarPecent);

            $listItems[] = [
                'name' => $name,
                'subscribers' => $subscribers,
                'time' => $timeAgo,
                'progressbar' => $progressbar,
                'avatarLink' => $avatarLink,
                'progressbarPecent' => $progressbarPecent[0] ?? 0,
            ];
        }

        Cache::put('channel_data', $listItems, 3600);

        return $listItems;
    }
}
