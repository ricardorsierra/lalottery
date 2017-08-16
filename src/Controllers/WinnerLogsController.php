<?php

namespace Ricardorsierra\Lalottery\Controllers;

use Ricardorsierra\Lalottery\Repositories\WinnerLogRepository;

class WinnerLogsController extends BaseController
{

    protected $winnerLogRepo;

    /**
     * WinnerLogsController constructor.
     *
     * @param WinnerLogRepository $repo
     */
    public function __construct(WinnerLogRepository $repo) 
    {
        parent::__construct();
        $this->winnerLogRepo = $repo;
    }

    /**
     * @return mixed
     */
    public function index() 
    {
        $logs = $this->winnerLogRepo->getAllPaginated(50);
        return View::make('winnerLogs.index', compact('logs'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getListOfAccount($id) 
    {
        $winnerLogs = $this->winnerLogRepo->getWinnerLogOfAccountByPaginated($id, 50);
        return View::make('winnerLogs.index', compact('winnerLogs', 'id'));
    }

}
