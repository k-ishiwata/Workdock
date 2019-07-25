<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Task;
use Faker\Generator as Faker;

$titles = [
    'バナー作成',
    'サイトマップの作成',
    'TOPページ　デザイン',
    'CMS検討と調査',
    '概要ページコーディング',
    '事例ページ原稿作成',
    'バナースライダーの実装',
    'ワイヤーフレーム作成',
    'プロジェクト舞の時間計測',
    'タスクのメモ機能',
    '日報機能',
    'ユーザーロールの実装',
    'WiKiの実装',
];

$factory->define(Task::class, function (Faker $faker) use ($titles) {
    static $loop = 0;
    $loop++;
    if ($loop >= count($titles)) {
        $loop = 0;
    }

    return [
//        'title' => $faker->realText($faker->numberBetween(15,40)),
        'title' => $titles[$loop],
        'status_id' => $faker->numberBetween(1, 4),
        'priority_id' => $faker->boolean(80) ? $faker->numberBetween(1, 3) : null,
        'project_id' => $faker->boolean(80) ? $faker->numberBetween(1, 3) : null,
        'user_id' => $faker->numberBetween(1, 2),
//        'due_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        // ランダムでnull
        'due_at' => $faker->boolean(20) ? $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 20 days')->format('Y-m-d H:i') : null,
    ];


});

//dateTimeBetween($startDate = 'now', $endDate = '+ 20 days', $timezone = null)
