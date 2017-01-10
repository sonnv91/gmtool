<?php
require_once('Cimongo.php');

class BaseDao extends Cimongo{

    protected $collection;

    function __construct(){
        parent::__construct();
    }

    public function findById($id){
        $where = array("_id" => new MongoId($id));
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
    }

    public function deleteById($id){
        $where = array("_id" => new MongoId($id));
        return $this->where($where)->delete($this->collection);
    }

    public function findByOwner($owner){
        $where = array("owner" => $owner);
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
    }

    public function findListByOwner($owner, $limit = false, $offset = false){
        $where = array("owner" => $owner);
        $list = $this
            ->get_where($this->collection, $where, $limit, $offset)
            ->result_object();
        return $list;
    }

    public function findLastestCollection(){
        $where = array();
        $entity = $this
            ->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
    }

    public function findListNewestCollection($limit = false){
        $where = array();
        $entity = $this
            ->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where, $limit, 0)
            ->result_object();
        return $entity;
    }

    public function save($entity){
        $updateData = array();
        foreach($entity as $key => $value){
            $updateData[$key] = $value;
        }
        if(!ValidateUtil::isEmpty($entity->_id)){
            $where = array('_id' => new MongoId($entity->_id));
            return $this->where($where)->update($this->collection, $updateData);
        }
        else
        {
            $updateData['_id'] = new MongoId();
            return $this->insert($this->collection, $updateData);
        }
    }

    public function aggre($aggre, $allowDiskUse = false){
        $aggregate = $this->aggregate($this->collection, $aggre, $allowDiskUse);
        return $aggregate;
    }
}