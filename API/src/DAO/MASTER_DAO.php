<?php

	abstract class MASTER_DAO
	{
	    public abstract function insert($obj);
	    public abstract function update($obj);
	    public abstract function delete($id);

	    private $db = null;
	    public function setDB($db)
	    {
	        $this->db = $db;
	    }
	    public function getDB()
	    {
	        return $this->db;
	    }
   	}

