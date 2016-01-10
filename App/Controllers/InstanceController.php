<?php

namespace App\Controllers;

use App\Connections\Connection;
use App\Helpers\RandomGenerator;
use App\Models\Instance;
use App\Repositories\InstanceRepository;

class InstanceController extends BaseController
{

    public function index()
    {
        $user = AuthController::auth();
        $instanceRepo = new InstanceRepository();
        $instances = $instanceRepo->getAll();

        $this->view('index.php', [
            'user' => $user,
            'instances' => $instances
        ]);
    }

    public function show($instanceId = "")
    {
        $user = AuthController::auth();
        $instanceRepo = new InstanceRepository();
        $instance = $instanceRepo->get($instanceId);

        $this->view('instance.php', [
            'user' => $user,
            'instance' => $instance
        ]);
    }

    public function edit()
    {
        $user = AuthController::auth();

        $instanceRepo = new InstanceRepository();
        $selectedInstance = $instanceRepo->get($_GET['id']);

        $this->view('instanceEdit.php', [
            'user' => $user,
            'selectedInstance' => $selectedInstance
        ]);
    }

    public function upsert()
    {
        $user = AuthController::auth();

        if ($this->isValid($_POST)) {
            $instanceRepo = new InstanceRepository();

            $pdo = Connection::connect();
            $pdo->beginTransaction();

            try {
                if ($_POST['id'] != "") {
                    $instance = $instanceRepo->get($_POST['id']);
                    $instance->name = $_POST['name'];
                    $instance->description = $_POST['description'];

                    $instanceRepo->update($instance);

                    $_SESSION['success'] = ['Successfully update an instance.'];
                } else {
                    $instance = new Instance();
                    $instance->id = $this->generateId();
                    $instance->password = $this->generatePassword();
                    $instance->userId = $user->id;
                    $instance->name = $_POST['name'];
                    $instance->description = $_POST['description'];

                    $instanceRepo->insert($instance);

                    $_SESSION['success'] = ['Successfully add an instance.'];
                }

                $pdo->commit();
            } catch (\Exception $e) {
                $pdo->rollBack();
                unset($_SESSION['success']);
            }

            header('Location: /');
        }
        else
        {
            if ($_POST['id'] != "")
            {
                header('Location: /instance/edit?id=' . $_POST['id']);
            }
            else
            {
                header('Location: /instance/edit');
            }
        }
    }

    private function isValid($postData)
    {
        $isValid = true;
        if ($postData['name'] == "")
        {
            $_SESSION['error'][] = 'Instance Name cannot be empty!';
            $isValid = false;
        }

        return $isValid;
    }

    private function generateId()
    {
        $id = RandomGenerator::alphanumeric(25);
        $instanceRepo = new InstanceRepository();

        while ($instanceRepo->get($id)->id != null)
        {
            $id = RandomGenerator::alphanumeric(25);
        }

        return $id;
    }

    private function generatePassword()
    {
        return RandomGenerator::alphanumeric(50);
    }
}