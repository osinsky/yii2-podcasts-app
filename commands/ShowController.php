<?php

declare(strict_types=1);

namespace app\commands;

use app\models\Show;
use app\services\ShowService;
use yii\console\Controller;
use yii\console\ExitCode;

class ShowController extends Controller
{
    public function actionIndex(): int
    {
        return ExitCode::OK;
    }

    public function actionUpdate()
    {
        $showService = new ShowService();

        $shows = Show::find()->all();
        foreach ($shows as $show) {
            $showService->update($show);
        }

        return ExitCode::OK;
    }
}
