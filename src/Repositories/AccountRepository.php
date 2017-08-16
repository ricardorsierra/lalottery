<?php

namespace Ricardorsierra\Lalottery\Repositories;

use Ricardorsierra\Lalottery\Models\Account;

class AccountRepository extends EloquentRepository
{

    /**
     * AccountRepository constructor.
     *
     * @param Account $model
     */
    public function __construct(Account $model) 
    {
        $this->model = $model;
    } 
}
