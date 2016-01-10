<?php

namespace App\Repositories;


interface IRepository
{
    public function getAll();

    public function get($id);

    public function insert($data);

    public function update($data);

    public function delete($id);
}