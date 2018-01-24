<?php

namespace app\controllers;

use app\Controller;
use app\models\Shingle;

class AdminController extends Controller
{
    public function indexAction()
    {
        if(isset($_POST["submit"])) {
            $file = $this->uploadFile();
            print_r($_POST);

            return true;
        }

        if (!(isset($_SESSION['auth'])))
        {
            header("Location: /login");
            return true;
        }
        
       return $this->render('admin/adm1n.php');
    }

    private function uploadFile()
    {
        $continue = true;
        $target_dir = "uploads/";
        $target_file = $target_dir . ($_FILES["fileToUpload"]["name"]);

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
// Allow certain file formats
        if($imageFileType != "docx" && $imageFileType != "doc") {
            echo "Sorry, only DOCX files is allowed.";
            $uploadOk = 0;
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return die("Sorry, your file was not uploaded.");

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
                    $text_id = Shingle::addFinishedShingles([
                        'title' =>  $_FILES["fileToUpload"]["name"],
                        'path' => $target_file
                    ]);
                }

                echo "The file ". $_FILES["fileToUpload"]["name"]. " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        return $text_id;
    }
}