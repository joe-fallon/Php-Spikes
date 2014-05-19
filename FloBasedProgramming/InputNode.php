<?php
/**
 * Created by PhpStorm.
 * User: joe
 * Date: 5/16/14
 * Time: 3:54 PM
 */

class InputNode
{
    private $_outputNode;

    public function __construct($outputNode)
    {
        $this->_outputNode = $outputNode;
    }

    public function inputData($data)
    {
        $outputNode = $this->_outputNode;
        $outputNode->inputData($data);
    }
} 
