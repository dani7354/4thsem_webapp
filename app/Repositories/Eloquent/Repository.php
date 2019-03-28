<?php
/**
 * Created by PhpStorm.
 * User: d
 * Date: 2019-03-28
 * Time: 09:36
 */

namespace App\Repositories\Eloquent;
use Exception;
use Illuminate\Support\Facades\App;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class Repository implements RepositoryInterface
{
    private $app;
    protected $model;

    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    public function model(){
        // will be overrided

    }

    public function makeModel() {
        $model = $this->model();

        if (!$model instanceof Model)
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->where('id', '=', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    function find($id, $columns = array('*'))
    {
        $this->model->find($id, $columns);
    }

    function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }
}