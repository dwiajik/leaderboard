<?php

namespace App\Repositories;


use App\Connections\Connection;
use App\Models\Instance;
use PDO;

class InstanceRepository implements IRepository
{
    private $getAllInstanceQuery = "SELECT * FROM instances";

    private $getInstanceQuery = "SELECT * FROM instances WHERE id = ?";

    private $insertInstanceQuery = "INSERT INTO instances (id, password, user_id, name, description) VALUES (?, ?, ?, ?, ?)";

    private $updateInstanceQuery = "UPDATE instances SET name = ?, description = ? WHERE id = ?";

    private $deleteInstanceQuery = "DELETE FROM instances WHERE id = ?";

    public function getAll()
    {
        $pdo = Connection::connect();
        $instances = array();
        foreach ($pdo->query($this->getAllInstanceQuery) as $row) {
            $instance = new Instance();
            $instance->id = $row['id'];
            $instance->password = $row['password'];
            $instance->userId = $row['user_id'];
            $instance->name = $row['name'];
            $instance->description = $row['description'];

            array_push($instances, $instance);
        }

        Connection::disconnect();
        return $instances;
    }

    public function get($id)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->getInstanceQuery);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $instance = new Instance();
        $instance->id = $data['id'];
        $instance->password = $data['password'];
        $instance->userId = $data['user_id'];
        $instance->name = $data['name'];
        $instance->description = $data['description'];
        Connection::disconnect();

        return $instance;
    }

    public function insert($data)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->insertInstanceQuery);
        $q->execute(array(
            $data->id,
            $data->password,
            $data->userId,
            $data->name,
            $data->description
        ));
        Connection::disconnect();
    }

    public function update($data)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->updateInstanceQuery);
        $q->execute(array(
            $data->name,
            $data->description,
            $data->id
        ));

        Connection::disconnect();
    }

    public function delete($id)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->deleteInstanceQuery);
        $q->execute(array($id));
        Connection::disconnect();
    }
}