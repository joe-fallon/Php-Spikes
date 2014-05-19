<?php

class RepeaterNode
{
    private $_outputNode;

    public function __construct($outputNode)
    {
        $this->_outputNode = $outputNode;
    }

    public function inputData($data)
    {
        $this->_outputNode->inputData($data);
    }
}
