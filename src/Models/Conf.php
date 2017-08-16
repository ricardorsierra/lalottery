<?php

namespace Ricardorsierra\Lalottery\Models;

use Laracasts\Presenter\PresentableTrait;

class Conf extends \Eloquent
{

    public $timestamps = false;
    protected $fillable = ['param', 'val', 'val2'];

    /**
     * @return bool
     */
    public static function isOverWeekTimes()
    {
        $model = Conf::where('param', '=', 'week')->lockForUpdate()->first();
        return $model->val2 == 0;
    }
}
