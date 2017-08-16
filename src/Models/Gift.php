<?php

namespace Ricardorsierra\Lalottery\Models;

class Gift extends \Eloquent
{

    protected $fillable = ['name', 'grade', 'rate', 'total', 'surplus', 'winner_count'];

    /**
     * @return mixed
     */
    public static function Lottery()
    {
        $gifts = Gift::all();
        foreach ($gifts as $gift) {
            $data[] = ['id' => $gift->id, 'name' => $gift->name, 'rate' => $gift->rate];
        }
        $x = Gift::Xrand($data);
        if (isset($x)) {
            return Gift::find($data[$x]['id']);
        }
    }

    /**
     * @param $data
     * @return int|string
     */
    private static function Xrand($data)
    {
        $baseRate = Conf::where('param', '=', 'base_rate')->first();
        $r = rand(1, $baseRate->val);
        $k = 0;
        foreach ($data as $key => $v) {
            $k+=$v['rate'];
            if ($r <= $k) {
                return $key;
            }
        }
    }

    /**
     * @param $query
     * @return mixed
     */
    public function ScopeByTodayCount($query)
    {
        $timestamp = Carbon::today();
        return $query->where('created_at', '>', $timestamp);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function ScopeByWeekCount($query)
    {
        $timestamp = Carbon::today()->startOfWeek();
        return $query->where('created_at', '>', $timestamp);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function ScopeByMonthCount($query)
    {
        $timestamp = Carbon::today()->startOfMonth();
        return $query->where('created_at', '>', $timestamp);
    }
}
