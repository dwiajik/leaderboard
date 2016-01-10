<?php

namespace App\Repositories;


use App\Connections\Connection;
use App\Models\User;
use PDO;

class UserRepository implements IRepository
{
    private $getAllUserQuery = "SELECT * FROM users";

    private $getUserQuery = "SELECT * FROM users WHERE id = ?";

    private $getUserByUsernameQuery = "SELECT * FROM users WHERE username = ? OR email = ?";

    private $insertUserQuery = "INSERT INTO users (email, username, password, fullname) VALUES (?, ?, ?, ?)";

    private $updateUserQuery = "UPDATE users SET email = ?, username = ?, password = ?, fullname = ? WHERE id = ?";

    private $deleteUserQuery = "DELETE FROM users  WHERE id = ?";

    public function getAll()
    {
        $pdo = Connection::connect();
        $users = array();
        foreach ($pdo->query($this->getAllUserQuery) as $row) {
            $user = new User();
            $user->id = $row['id'];
            $user->email = $row['email'];
            $user->username = $row['username'];
            $user->password = $row['password'];
            $user->fullname = $row['fullname'];

            array_push($users, $user);
        }

        Connection::disconnect();
        return $users;
    }

    public function get($id)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->getUserQuery);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $user = new User();
        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->fullname = $data['fullname'];
        Connection::disconnect();

        return $user;
    }

    public function getByUsername($username)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->getUserByUsernameQuery);
        $q->execute(array($username, $username));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        $user = new User();
        $user->id = $data['id'];
        $user->email = $data['email'];
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->fullname = $data['fullname'];
        Connection::disconnect();

        return $user;
    }

    public function insert($data)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->insertUserQuery);
        $q->execute(array($data->email, $data->username, $data->password, $data->fullname));
        Connection::disconnect();
    }

    public function update($data)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->updateUserQuery);
        $q->execute(array($data->email, $data->username, $data->password, $data->fullname, $data->id));

        Connection::disconnect();
    }

    public function delete($id)
    {
        $pdo = Connection::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($this->deleteUserQuery);
        $q->execute(array($id));
        Connection::disconnect();
    }
}