<?php

namespace Ricardorsierra\Lalottery\Repositories;

use Ricardorsierra\Lalottery\Models\WinnerLog;

class WinnerLogRepository extends EloquentRepository
{

    /**
     * WinnerLogRepository constructor.
     *
     * @param WinnerLog $model
     */
    public function __construct(WinnerLog $model) 
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @param $count
     * @return mixed
     */
    public function getWinnerLogOfScriptByPaginated($id, $count) 
    {
        return $this->model
            ->where('user_id', '=', $id)
            ->paginate($count);
    }

    /**
     * @param CreatorListener $observer
     * @param $data
     * @param null            $validator
     * @return mixed
     */
    public function create(CreatorListener $observer, $data, $validator = null) 
    {
        if ($validator && $validator->fails()) {
            return $observer->CreateError($validator->messages());
        }

        $model = $this->getNew($data);

        if (!$this->save($model)) {
            return $observer->CreateError($model->getErrors());
        }

        return $observer->Created($model);
    }

}
