<?php


class Bug extends ActiveBean
{
    const TABLE_NAME = 'bug';
    
    /** @var string */
    protected $_description;

    private function __construct(RedBean_OODBBean $bean)
    {
        $this->_bean = $bean;
        parent::__construct();
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
    public function getDescription()
    {
        return $this->_description;
    }
    
    public function setDescription($val)
    {
        $this->_description = $val;
    }
    
    public static function create()
    {
        $bug = new Bug();
        $bug->_bean = R::dispense(self::TABLE_NAME);
        
        return $bug;
    }
    
    public function save()
    {
        $bean = $this->_bean;
        self::populateBean($bean, $this);
        $this->_id = R::store($bean);
        
        return $this->_id;
    }
    
    public static function retrieve($id)
    {
        $bean = R::load(self::TABLE_NAME, $id);
        $bug  = new Bug($bean);
        self::populateObject($bean, $bug);
        
        return $bug;
    }
    
    /**
     * populateBean
     * 
     * @param RedBean_OODBBean $bean
     * @param stdClass $obj
     */
    protected static function populateBean(RedBean_OODBBean $bean, $object)
    {
        $bean->id = $object->_id;        
        $bean->description = $object->_description;
    }
    
    /**
     * populateObject
     * 
     * @param RedBean_OODBBean $bean
     * @param stdClass $obj
     */
    protected static function populateObject(RedBean_OODBBean $bean, $object)
    {
        $object->_id = $bean->id;
        $object->_description = $bean->description;
    }
}