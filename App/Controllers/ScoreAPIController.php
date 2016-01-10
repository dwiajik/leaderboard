<?php

namespace App\Controllers;

use App\Repositories\InstanceRepository;
use App\Repositories\ScoreRepository;

class ScoreAPIController extends BaseController
{
    private function auth($id, $password)
    {
        $instanceRepo = new InstanceRepository();
        $instance = $instanceRepo->get($id);
        if ($instance->password == $password)
        {
            return true;
        }

        return false;
    }

    /*
        Arguments:
        - id: Instance API ID
        - password: Instance API Password
        - limit: Limit the top score returned

        Return:
        - scores: Array of scores
            - id: Score ID
            - name: Score Name
            - score: the score
        - count: count of all scores
    */
    public function get()
    {
        $request = json_decode(file_get_contents("php://input"));

        if (!$this->auth($request->id, $request->password))
        {
            http_response_code(401);
        }
        else
        {
            $scoreRepo = new ScoreRepository();
            $scores = $scoreRepo->getScoreByInstanceId($request->id);

            $count = count($scores);

            usort($scores, function ($a, $b) {
                if ($a->score == $b->score) {
                    return 0;
                }
                return ($a->score < $b->score) ? 1 : -1;
            });

            $scores = array_slice($scores, 0, $request->limit);

            foreach ($scores as $score)
            {
                $row = array();
                $row['id'] = $score->id;
                $row['name'] = $score->name;
                $row['score'] = $score->score;

                $returnData['scores'][] = $row;
            }
            $returnData['count'] = $count;

            header('Content-Type: application/json');
            echo json_encode($returnData);
        }
    }

    /*
        Arguments:
        - id: Instance API ID
        - password: Instance API Password
        - scoreId: Score ID

        Return:
        - score:
            - id: Score ID
            - name: Score Name
            - score: the score
        - count: count of all scores
        - rank: rank from all score
    */
    public function getById()
    {
        $request = json_decode(file_get_contents("php://input"));

        if (!$this->auth($request->id, $request->password))
        {
            http_response_code(401);
        }
        else
        {
            $scoreRepo = new ScoreRepository();
            $scores = $scoreRepo->getScoreByInstanceId($request->id);
            $score = $scoreRepo->get($request->scoreId);

            $count = count($scores);

            usort($scores, function ($a, $b) {
                if ($a->score == $b->score) {
                    return 0;
                }
                return ($a->score < $b->score) ? 1 : -1;
            });

            $rank = 0;
            foreach ($scores as $row)
            {
                $rank += 1;
                if ($row->id == $request->scoreId)
                {
                    break;
                }
            }

            $returnData['score']['id'] = $score->id;
            $returnData['score']['name'] = $score->name;
            $returnData['score']['score'] = $score->score;
            $returnData['count'] = $count;
            $returnData['rank'] = $rank;

            header('Content-Type: application/json');
            echo json_encode($returnData);
        }
    }

    /*
        Arguments:
        - id: Instance API ID
        - password: Instance API Password
        - score:
            - id: Score ID (optional, fill to update, blank to insert)
            - name: Score Name
            - score: the score

        Return:
        - id: Score ID
        - name: Score Name
        - score: the score
        - count: count of all scores
        - rank: rank from all score
    */
    public function upsert()
    {
        $request = json_decode(file_get_contents("php://input"));

        if (!$this->auth($request->id, $request->password))
        {
            http_response_code(401);
        }
        else
        {
            $scoreRepo = new ScoreRepository();

            if ($request->score->id == null || $request->score->id == "")
            {
                $data = $request->score;
                $data->instanceId = $request->id;
                $returnData['id'] = $scoreRepo->insert($data);
            }
            else
            {
                $data = $request->score;
                $data->instanceId = $request->id;
                $scoreRepo->update($data);
                $returnData['id'] = $request->score->id;
            }

            $scores = $scoreRepo->getScoreByInstanceId($request->id);

            $count = count($scores);

            usort($scores, function ($a, $b) {
                if ($a->score == $b->score) {
                    return 0;
                }
                return ($a->score < $b->score) ? 1 : -1;
            });

            $rank = 0;
            foreach ($scores as $row)
            {
                $rank += 1;
                if ($row->id == $returnData['id'])
                {
                    break;
                }
            }

            $returnData['name'] = $request->score->name;
            $returnData['score'] = $request->score->score;
            $returnData['count'] = $count;
            $returnData['rank'] = $rank;

            header('Content-Type: application/json');
            echo json_encode($returnData);
        }
    }

    /*
        Arguments:
        - id: Instance API ID
        - password: Instance API Password
        - scoreId: Score ID

        Return:
        - id: Score ID
        - name: Score Name
        - score: the score
        - count: count of all scores
    */
    public function delete()
    {
        $request = json_decode(file_get_contents("php://input"));

        if (!$this->auth($request->id, $request->password))
        {
            http_response_code(401);
        }
        else
        {
            $scoreRepo = new ScoreRepository();
            $score = $scoreRepo->get($request->scoreId);

            $scoreRepo->delete($request->scoreId);

            $scores = $scoreRepo->getScoreByInstanceId($request->id);
            $count = count($scores);

            $returnData['score']['id'] = $score->id;
            $returnData['score']['name'] = $score->name;
            $returnData['score']['score'] = $score->score;
            $returnData['count'] = $count;

            header('Content-Type: application/json');
            echo json_encode($returnData);
        }
    }
}