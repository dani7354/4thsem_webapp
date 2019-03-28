<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    function all($columns = array('*'));
    function create(array $data);
    function delete($id);
    function update($id, array $data);
    function find($id, $columns = array('*'));
    function findBy($attribute, $value, $columns = array('*'));
}