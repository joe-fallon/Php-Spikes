<?php

abstract class ActiveBean
{
    /** @var RedBean_OODBBean */
    protected $_bean;
    /** @var int */
    protected $_id;
    
    protected function __construct()
    {
        $this->_id = 0;
    }
    
    /**
     * populateBean
     * 
     * @param RedBean_OODBBean $bean
     * @param stdClass $obj
     */
    abstract protected static function populateBean(RedBean_OODBBean $bean, $obj);
    
    /**
     * populateObject
     * 
     * @param RedBean_OODBBean $bean
     * @param stdClass $obj
     */
    abstract protected static function populateObject(RedBean_OODBBean $bean, $obj);
}