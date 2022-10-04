<?php

declare(strict_types=1);

namespace app\services;

use app\enums\DownloadStatus;
use app\models\Download;
use GuzzleHttp\Client;

class DownloadService
{
    public function download(string $link, string $filename)
    {
        $download = new Download();
        $download->status = DownloadStatus::IN_PROGRESS->value;
        $download->link = $link;
        $download->filename = $filename;
        $download->save();

        $path = dirname(__DIR__) . Download::dirName() . $filename;

        $client = new Client();
        $response = $client->get($link, ['sink' => $path]);

        $download->status = DownloadStatus::COMPLETED->value;
        $download->save();
    }
}
