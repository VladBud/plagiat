<?php

class Shingle
{
    public static function getShingles()
    {
        $db = Db::getConnection();
        $stmt = $db->query('SELECT * FROM shingles');
        $row = $stmt->fetch();

        return $row;
    }
}