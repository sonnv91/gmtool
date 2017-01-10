<?php

class PlayerDao extends BaseDao{


    function __construct(){
        parent::__construct();
        //$this->collection = new MongoCollection($this->db, 'players');
        $this->collection = "players";
    }

    public function findListPlayer($key = -1, $offset, $limit){
        $where = array();
        if($key != -1){
            $where = array(
                '$or' => array(
                    array('owner' => new MongoRegex("/$key/i")),
                    array('name' => new MongoRegex("/$key/i"))
                )
            );
        }
        $players = $this
            //->order_by(array("createTime"=> -1))
            ->get_where($this->collection, $where, $limit, $offset)
            ->result_object();
        return $players;
    }

    public function countAllPlayer($key = -1){
        $where = array();
        if($key != -1){
            $where = array(
                '$or' => array(
                    array('owner' => new MongoRegex("/$key/i")),
                    array('name' => new MongoRegex("/$key/i"))
                )
            );
        }
        return $this->get_where($this->collection, $where)->count();
    }

    public function updateById($id, $updateData){
        $where = array(
            "_id" => new MongoId($id)
        );
        return $this->where($where)->update($this->collection, $updateData);
    }

    public function findByPlayerCode($owner){
        $where = array("code" => $owner);
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
    }

    public function findByClanId($clanId){
        $where = array("clanId" => $clanId);
        $entity = $this
            ->order_by(array("level"=> -1))
            ->get_where($this->collection, $where)
            ->result();
        return $entity;
    }
	
	public function findTopHoason($server){
		$where = array('server' => $server, 'rank' => array('$gt' => 0));
        $entity = $this
			->select(array("code","name","rank"))
            ->order_by(array("rank"=> 1))
            ->get_where($this->collection, $where, 10, 0)
            ->result_object();
        return $entity;
	}
	public function findTopLevel($server){
		$where = array('server' => $server);
        $entity = $this
			->select(array("code","name","level"))
            ->order_by(array("level"=> -1))
            ->get_where($this->collection, $where, 20, 0)
            ->result_object();
        return $entity;
	}
	public function findTopMetaPower($server){
		$where = array('server' => $server);
        $entity = $this
			->select(array("code","name","metaPower"))
            ->order_by(array("metaPower"=> -1))
            ->get_where($this->collection, $where, 20, 0)
            ->result_object();
        return $entity;
	}

    public function findListVip($server){
        $where = array('server' => $server, 'vip' => array('$gt' => 0));
        $entity = $this
            ->select(array("code","vip"))
            ->order_by(array("vip"=> 1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
    }
	
	public function listPlayerHS($server){
		$where = array('server' => $server, 'rank' => array('$gt' => 0));
        $entity = $this
            ->select(array("owner","rank"))
            ->order_by(array("rank"=> 1))
            ->get_where($this->collection, $where, 1000, 0)
            ->result_object();
        return $entity;
	}
	
	public function level60(){
		$where = array('level' => array('$gte' => 60));
		$entity = $this
            ->select(array("code","name","server"))
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
	}
	
	public function updateCoinHoard($id, $coinHoard){
		$where = array(
            "_id" => new MongoId($id)
        );
		$updateData = array('coinHoard' => $coinHoard);
        return $this->where($where)->update($this->collection, $updateData);
	}
	
	public function updateCoin($id, $coin){
		$where = array(
            "_id" => new MongoId($id)
        );
		//$updateData = array('$inc' => array('coin' => $coin));
        return $this->where($where)->inc('coin', $coin)->update($this->collection, array());
	}
}