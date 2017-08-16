<?php

namespace Ricardorsierra\Lalottery\Models;

use Laracasts\Presenter\PresentableTrait;

class Account extends \Eloquent
{

    public $timestamps = false;

    /**
     * @param $id
     * @return bool
     */
    public static function isOverTodayTimes($id)
    {
        if (Cache::has($id)) {
            if (Cache::get($id) >= 10) {
                return true;
            }

            Cache::increment($id);
            return false;
        }

        $expiresAt = Carbon::tomorrow();
        Cache::put($id, 1, $expiresAt);
        return false;
    }

    /**
     * @param $id
     * @return int
     */
    public static function surplus($id)
    {
        if (Cache::has($id)) {
            return 10 - Cache::get($id);
        }

        return 9;
    }
}
