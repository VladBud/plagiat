<?php

namespace app\controllers;

use app\Controller;
use components\Logger;
use components\Plagiat;
use app\models\Shingle;
use components\DocxConversion;

class IndexController extends Controller
{
    public function indexAction()
    {
        if(isset($_POST["submit"])) {
            $file = $this->uploadFile();

            $allFiles =  Shingle::selectAllFiles();
            if (!isset($file['text_id']))
                return $this->render('main/index.php', ['answer' => $file]);
            
            $singleFile = Shingle::selectFile($file['text_id']);
            
            $file1 = new DocxConversion($singleFile);
            $text1 = $file1->convertToText();

            $results = [];

            foreach ($allFiles as $files)
            {
                $file2 = new DocxConversion($files);

                $result = new Plagiat($file2->convertToText(), $file1->convertToText());
                $results[$files] = $result->get();

                $msg = $files . ' : ' . $results[$files] . '% співпадінь';

                Logger::log($msg, true, false);
            }
            
            $finish = 100 - max($results);

            if (Shingle::deleteFile($file['text_id']))
                unlink($singleFile);

            return $this->render('main/index.php', ['finish' => $finish]);
        }

        return $this->render('main/index.php');
    }

    private function uploadFile()
    {
        $answer = [];

        $continue = true;
        $target_dir = "temp/";
        $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $answer[] = "Вибачте, Ваш файл завеликий";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($fileType != "docx" && $fileType != "pdf") {
            $answer[] =  "Дозволяється завантажувати тільки DOCX або PDF-файли";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $answer[] = "Вибачте, Ваш файл не був завантажений";

        // if everything is ok, try to upload file
        } else {

            if($text_id = Shingle::checkFileExist([
                'title' =>  $_FILES["fileToUpload"]["name"],
                'path' => $target_file
            ])){
                $continue = false;
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                if ($continue){
                $text_id = Shingle::addShingles([
                    'title' =>  $_FILES["fileToUpload"]["name"],
                    'path' => $target_file
                ], 'move');}

                $answer[] =  "The file ". $_FILES["fileToUpload"]["name"]. " has been uploaded.";
                $answer['text_id'] = $text_id;

            } else {
                $answer[] =  "На жаль, під час перевірки файлу сталася помилка. Спробуйте ще раз";
            }
        }
        
        return $answer;
    }
}
