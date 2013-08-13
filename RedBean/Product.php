<?php

class Product
{
    const TABLE_NAME = 'product';
    
    protected $_id;
    protected $_name;
    
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
    
    public static function create()
    {
        $product = new Product();
        $product->_bean = R::dispense(self::TABLE_NAME);
        $product->_id = 0;
        
        return $product;
    }
    
    public function save()
    {
        self::populateBean($this->_bean, $this);
        
        $this->_id = R::store($this->_bean);
        
        return $this->_id;
    }
    
    public static function retrieve($id)
    {
        $product = new Product();
        
        $b = R::load(self::TABLE_NAME, $id);
        $product->_bean = $b;
        
        
        self::populateObject($b, $product);
        
        
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