<?php

namespace sunmale\fm\manger;



interface Manger
{

    public function find();

    public function select();

    public function insert();

    public function save();

    public function update();

    public function delete();
}