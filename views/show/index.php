<?php declare(strict_types=1);

use app\models\Show;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var yii\web\View $this */
/* @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Shows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Create Show', ['create'], ['class' => 'btn btn-success']); ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'link',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Show $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>


</div>
