<?php

namespace App\Services;
use PHPHtmlParser\Dom;

class ParserService
{
    public function index()
    {
        $dom = new Dom;
        $dom->loadFromUrl('https://www.twitchmetrics.net/channels/follower');

        $result = $dom->find('.list-group .list-group-item');

        $listItems = [];

        for($i = 0; $i < count($result); $i++)
        {
            $name = $result[$i]->find('h5')->text;
            $subscribers = $result[$i]->find('samp')->text;
            $timeAgo = $result[$i]->find('time')->text;
            $progressbar = $result[$i]->find('.progress-bar');
            $avatar = $result[$i]->find('img');

            $avatarLink = $avatar->getAttribute('src');
            preg_match('/\d+/', $progressbar->getAttribute('style'), $progressbarPecent);

            $listItems[] = [
                'name' => $name,
                'subscribers' => $subscribers,
                'time' => $timeAgo,
                'progressbar' => $progressbar,
                'avatarLink' => $avatarLink,
                'progressbarPecent' => $progressbarPecent[0]
            ];
        }

        // Повертаємо масив спарсених даних
        return $listItems;
    }
}