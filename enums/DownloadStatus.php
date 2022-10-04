<?php

declare(strict_types=1);

namespace app\enums;

enum DownloadStatus: int
{
    case NOT_STARTED = 10;
    case IN_PROGRESS = 20;
    case WAITING = 30;
    case COMPLETED = 40;
}
