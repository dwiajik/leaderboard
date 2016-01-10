<?php

namespace App\Repositories;


use App\Connections\Connection;
use App\Models\Score;
use PDO;

class ScoreRepository implements IRepository
{
    private $getAllScoreQuery = "SELECT * FROM scores";

    private $getScoreQuery = "SELECT * FROM scores WHERE id = ?";

    private $getScoreByInstanceIdQuery = "SELECT * FROM scores WHERE instance_id = ?";

    private $insertScoreQuery = "INSERT INTO scores (instance_id, name, score) VALUES (?, ?, ?)";

    private $updateScoreQuery = "UPDATE scores SET name = ?, score = ? WHERE id = ?";

    private $deleteScoreQuery = "DELETE FROM scores WHERE id = ?";

    public function getAll()
    {
        $pdo = Connection::connect();
        $scores = array();
        foreach ($pdo->query($this->getAllScoreQuery) as $row) {
            $score = new Score();
            $score->id = $row['id'];
            $score->instanceId = $row['instance_id'];
            $score->name = $row['name'];
            $score->score = $row['score'];

            $scores[] = $score;
        }

        Connection::disconnect();
        return $scores;
    }

    public function get($id)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->getScoreQuery);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $score = new Score();
        $score->id = $data['id'];
        $score->instanceId = $data['instance_id'];
        $score->name = $data['name'];
        $score->score = $data['score'];
        Connection::disconnect();

        return $score;
    }

    public function getScoreByInstanceId($instanceId)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->getScoreByInstanceIdQuery);
        $q->execute(array($instanceId));
        $data = $q->fetchAll();

        $scores = array();

        foreach ($data as $row) {
            $score = new Score();
            $score->id = $row['id'];
            $score->instanceId = $row['instance_id'];
            $score->name = $row['name'];
            $score->score = $row['score'];

            $scores[] = $score;
        }

        Connection::disconnect();
        return $scores;
    }

    public function insert($data)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->insertScoreQuery);
        $q->execute(array(
            $data->instanceId,
            $data->name,
            $data->score
        ));
        Connection::disconnect();

        return $pdo->lastInsertId();
    }

    public function update($data)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->updateScoreQuery);
        $q->execute(array(
            $data->name,
            $data->score,
            $data->id
        ));

        Connection::disconnect();
    }

    public function delete($id)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->deleteScoreQuery);
        $q->execute(array($id));
        Connection::disconnect();
    }
}