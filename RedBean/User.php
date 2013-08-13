<?php

class User
{
    const TABLE_NAME = 'user';
    
    protected $_id;
    protected $_name;
    protected $_bean;
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getName()
    {
        return $this->_name;
    }
    
    public function setName($val)
    {
        $this->_name = $val;
    }
    
    public function getReportedBug()
    {
        return $_bean->ownReportedBugs;
    }
    
    public function addReportedBug(Bug $bug)
    {
        $this->_bean->ownReportedBugs[] = $bug->_bean;
        R::store($this->_bean);
    }
    
    public function removeReportedBug($bug)
    {
        
    }
    
    public static function create()
    {
        $user = new User();
        $user->_bean = R::dispense(self::TABLE_NAME);
        $user->_id = 0;
        
        return $user;
    }
    
    public function delete()
    {
        
    }
    
    public function save()
    {
        self::populateBean($this->_bean, $this);
        
        $this->_id = R::store($this->_bean);
        
        return $this->_id;
    }
    
    public static function retrieve($id)
    {
        $user = new User();
        
        $b = R::load(self::TABLE_NAME, $id);
        $user->_bean = $b;
        
        
        self::populateObject($b, $user);
        
        
        return $bug;
    }
    
    protected static function populateBean($bean, $object)
    {
        $bean->id = $object->_id;        
        $bean->name = $object->_name;
    }
    
    protected static function populateObject($bean, $object)
    {
        $object->_id = $bean->id;
        $object->_name = $bean->name;
    }
}