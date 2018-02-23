<?php

namespace app\models;

use app\Model;

class Shingle extends Model
{
    public static function addShingles($text = false, $debug = false)
    {

        if ($text)
        {

            $stmt = self::$db->prepare("INSERT INTO files(title, path) VALUES(:title, :path) ");
            $stmt->execute([
                'title' => $text['title'],
                'path' => $text['path']
            ]);

            $last_insert_id = self::$db->lastInsertId();

            return $last_insert_id;
        }
        return false;
    }

    public static function addFinishedShingles($text = false)
    {
        if ($text)
        {

            $stmt = self::$db->prepare("INSERT INTO finished_files(title, path) VALUES(:title, :path) ");
            $stmt->execute([
                'title' => $text['title'],
                'path' => $text['path']
            ]);

            return true;
        }

        return false;
    }

    public static function checkFileExist($text)
    {
        if (file_exists($text['path']))
        {
            $stmt = self::$db->prepare("DELETE FROM files WHERE title = :title ");
            $stmt->execute([
                'title' => $text['title']
            ]);

            unlink($text['path']);

            return self::addShingles($text);
        }
        return false;
    }

    public static function selectAllFiles()
    {
            $stmt = self::$db->query('SELECT path FROM finished_files');

            $data = [];

            $count = 0;
            while ($row = $stmt->fetch())
            {
                $data[$count] = $row['path'];
                $count++;
            }

            return $data;
    }

    public static function selectFile($id)
    {
        $stmt = self::$db->prepare('SELECT path FROM files WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);

        $ink = $stmt->fetch();
        return $ink['path'];
    }
    
    public static function deleteFile($id)
    {
        $stmt = self::$db->prepare('DELETE FROM files WHERE id = :id');
        $stmt->execute([
            'id' =>$id 
        ]);

        return true;
    }
}