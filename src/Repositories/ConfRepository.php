<?php

namespace Ricardorsierra\Lalottery\Repositories;

use Ricardorsierra\Lalottery\Models\Conf;

class ConfRepository extends EloquentRepository
{

    /**
     * ConfRepository constructor.
     *
     * @param Conf $model
     */
    public function __construct(Conf $model) 
    {
        $this->model = $model;
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

    /**
     * @param UpdaterListener $observer
     * @param $model
     * @param $data
     * @param null            $validator
     * @return mixed
     */
    public function update(UpdaterListener $observer, $model, $data, $validator = null) 
    {

        if ($validator && $validator->fails()) {
            return $observer->CreateError($validator->messages());
        }

        $model->fill($data);

        if (!$this->save($model)) {
            return $observer->UpdateError($model->getErrors());
        }
        return $observer->Updated($model);
    }

    /**
     * @param DeleterListener $observer
     * @param $model
     * @return mixed
     */
    public function deleteModel(DeleterListener $observer, $model) 
    {
        $this->delete($model);
        return $observer->Deleted($model);
    }

}
