<?php

namespace app\controllers;

use app\Controller;
use app\models\Shingle;
use components\Converter;
use ZipArchive;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth->checkAuth(false, 'loginpage');
    }

    private $formats = [
        'docx',
        'pdf',
    ];

    public function indexAction()
    {
        if(isset($_POST["submit"])) {
            $file = $this->uploadFile();
            return $this->render('admin/adm1n.php', ['answer' =>$file]);
        }
        
       return $this->render('admin/adm1n.php');
    }

    private function uploadFile()
    {
        $answer = [];
        $counter = 0;

        $continue = true;
        $target_dir = "uploads/";
        $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
           $answer[$counter]['msg'] =  "Sorry, your file is too large.";
           $answer[$counter]['type'] =  "error";
            $counter++;
            $uploadOk = 0;
        }
// Allow certain file formats
        if($fileType != "docx" && $fileType != "pdf" && $fileType != "zip") {
            $answer[$counter]['msg'] =  "Sorry, only DOCX, PDF or ZIP files is allowed.";
            $answer[$counter]['type'] =  "error";
            $counter++;
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $answer[$counter]['msg'] = ("Sorry, your file was not uploaded.");
            $answer[$counter]['type'] =  "error";
            $counter++;

// if everything is ok, try to upload file
        } else {

            if($text_id = Shingle::checkFileExist([
                'title' =>  $_FILES["fileToUpload"]["name"],
                'path' => $target_file
            ])){
                $continue = false;
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                if ($continue && $fileType != "zip"){
                    $text_id = Shingle::addFinishedShingles([
                        'title' =>  $_FILES["fileToUpload"]["name"],
                        'path' => $target_file
                    ]);
                }

                $answer[$counter]['msg'] =  "The file ". $_FILES["fileToUpload"]["name"]. " has been uploaded.";
                $answer[$counter]['type'] =  "ok";
                $counter++;

                if( $fileType === "zip") {
                    $zip = new ZipArchive;
                    $res = $zip->open('uploads/'. $_FILES["fileToUpload"]["name"]);

                    if ($res === TRUE) {
                        for($i = 0; $i < $zip->numFiles; $i++) {

                            if(! is_dir($zip->getNameIndex($i)))
                            {
                                $explode = explode(".", $zip->getNameIndex($i));
                                
                                if (in_array(end($explode), $this->formats))
                                {
                                    $zip->extractTo('uploads/', array($zip->getNameIndex($i)));

                                    $explode2 = explode('/',$zip->getNameIndex($i));
                                    $basename = basename(end($explode2));
                                    array_pop($explode2);

                                    $name = '';

                                    foreach ($explode2 as $item) {
                                        $name .= $item . '/';
                                    }

                                    Shingle::addFinishedShingles([
                                        'title' =>  $zip->getNameIndex($i),
                                        'path' => 'uploads/'. $name  . $basename
                                    ]);
                                }
                            }
                        }
                        $zip->close();



                        unlink('uploads/'. $_FILES["fileToUpload"]["name"]);

                    } else {
                        die ('doh!');
                    }
                }


            } else {
                $answer[$counter]['msg'] =  "Sorry, there was an error uploading your file.";
                $answer[$counter]['type'] =  "error";
                $counter++;
            }
        }

        return $answer;
    }

    public function parserAction()
    {
        

        $page = file_get_contents('http://ua.textreferat.com/referat-19679-1.html');
        return $this->render('admin/parser.php', [
            'page' => $page
        ]);
    }
}
