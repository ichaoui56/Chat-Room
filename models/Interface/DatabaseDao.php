<?php

interface DatabaseDao
{
    public function query($sql);
    public function bind($param, $value, $type = null);
    public function execute();
    public function checkParam(...$valueCol);
    public function single();
    public function resultSet();
    public function rowCount();
}