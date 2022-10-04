<?php

declare(strict_types=1);

namespace app\services;

use app\jobs\DownloadJob;
use app\models\Download;
use app\models\Enclosure;
use app\models\Episode;
use app\models\Show;
use Ramsey\Uuid\Uuid;
use Yii;

class ShowService
{
    public function update(Show $show)
    {
        $downloadService = new DownloadService();
        $uuid = Uuid::uuid4();
        $filename = $uuid . '.xml';
        $downloadService->download($show->link, $filename);

        $path = dirname(__DIR__) . Download::dirName() . $filename;

        $xml = simplexml_load_file($path);
        foreach ($xml->channel->item as $item) {
            $this->saveEpisode($show->id, $item);
        }
    }

    public function saveEpisode(int $showId, $item)
    {
        $link = (string) $item->link;
        $episode = Episode::findOne(['link' => $item->link]);
        if ($episode === null) {
            $episode = new Episode();
        }
        $episode->show_id = $showId;
        $episode->title = (string) $item->title;
        $episode->description = (string) $item->description;
        $episode->link = $link;
        $episode->guid = (string) $item->guid;
        $episode->pub_date = (string) $item->pubDate;
        $result = $episode->save();
        if ($result) {
            $this->saveEnclosure($episode->id, $item->enclosure);
        }
        exit;
    }

    public function saveEnclosure(int $episodeId, $item)
    {
        $url = (string) $item['url'];
        $enclosure = Enclosure::findOne(['url' => $url]);
        if ($enclosure === null) {
            $enclosure = new Enclosure();
        }
        $enclosure->episode_id = $episodeId;
        $enclosure->url = $url;
        $enclosure->type = (string) $item['type'];
        $enclosure->length = (int) $item['length'];
        $result = $enclosure->save();
        if ($result) {
            $uuid = Uuid::uuid4();
            $filename = $uuid . '.mp3';
            $path = dirname(__DIR__) . Download::dirName() . $filename;
            Yii::$app->queue->push(new DownloadJob([
                'url' => $enclosure->url,
                'file' => $path,
            ]));
        }
    }
}
