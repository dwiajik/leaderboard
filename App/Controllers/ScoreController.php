<?php

namespace App\Controllers;

use App\Connections\Connection;
use App\Helpers\RandomGenerator;
use App\Models\Instance;
use App\Repositories\InstanceRepository;
use App\Repositories\ScoreRepository;

class ScoreController extends BaseController
{

    public function index($instanceId)
    {
        $user = AuthController::auth();
        $scoreRepo = new ScoreRepository();
        $scores = $scoreRepo->getScoreByInstanceId($instanceId);

        $instanceRepo = new InstanceRepository();
        $instance = $instanceRepo->get($instanceId);

        usort($scores, function ($a, $b) {
            if ($a->score == $b->score) {
                return 0;
            }
            return ($a->score < $b->score) ? 1 : -1;
        });

        $this->view('score.php', [
            'user' => $user,
            'scores' => $scores,
            'instance' => $instance
        ]);
    }
}