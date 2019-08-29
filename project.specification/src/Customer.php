<?php


class Customer
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->type;
    }

}