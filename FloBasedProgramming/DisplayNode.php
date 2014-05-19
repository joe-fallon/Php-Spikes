<?php


class DisplayNode implements InputNodeInterface
{
    public function inputData($data)
    {
        echo $data;
    }
} 
