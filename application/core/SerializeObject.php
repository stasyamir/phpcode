<?php
/**
 * Created by PhpStorm.
 * User: Станислав Мирошник
 * Date: 11/29/2018
 * Time: 12:26 PM
 */

namespace application\core;


class SerializeObject
{
    private $title;
    private $status;

    public function __construct($title, $status)
    {
        $this->title = $title;
        $this->status = $status;
    }

    public function editTitle($title) {
        $this->title = $title;
    }

    public function editStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTitle() {
        return $this->title;
    }

    public function resultSerialize(){
        $res = serialize($this);
        return $res;
    }



}