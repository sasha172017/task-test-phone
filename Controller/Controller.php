<?php


namespace Controller;


class Controller
{
    private $_post;
    private $_method;
    private $_isPost = false;

    public function __construct()
    {
        $this->_method = $_SERVER['REQUEST_METHOD'];
        if($this->_method == 'POST'){
            $this->_post = $_POST;
            $this->_isPost = true;
        }
    }

    public function isPost(){
        return $this->_isPost;
    }

    public function post($value = null){
        return $value ? $this->_post[$value] : $this->_post;
    }
}