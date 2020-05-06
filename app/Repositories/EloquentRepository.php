<?php

namespace App\Repositories;

use App\Helpers\Constant;
use App\Helpers\Encrypt;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get model.
     * @return string
     */
    abstract protected function getModel();

    /**
     * Set model.
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getInstance() {
        if ($this->_model === null) {
            $this->setModel();
            return $this->_model;
        }
        return $this->_model;
    }

    /**
     *
     */
    public function getDBTable() {

    }


    /**
     * Get all.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll() {
        return $this->_model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id) {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes) {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes) {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id) {
        $result = $this->find($id);
        if($result) {
            $result->delete();
            return true;
        }
        return false;
    }

    public function softDelete($dataId) {
        $tableName = $this->getInstance()->getTable();
        try {
            return DB::table($tableName)
                ->whereIn('id', $dataId)
                ->update([
                   'deleted' => Constant::IS_DELETED
                ]);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
