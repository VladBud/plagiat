<?php

namespace app\controllers;

use ZipArchive;
use app\Controller;
use app\models\User;
use app\models\Shingle;

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
            return $this->render('admin/admin.php', ['answer' =>$file]);
        }
        
       return $this->render('admin/admin.php');
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
        if ($_FILES["fileToUpload"]["size"] > 500000000) {
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
                     Shingle::addFinishedShingles([
                        'title' =>  $_FILES["fileToUpload"]["name"],
                        'path' => $target_file
                    ]);
                }

                $answer[$counter]['msg'] =  "The file ". $_FILES["fileToUpload"]["name"]. " has been uploaded.";
                $answer[$counter]['type'] =  "ok";

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
                $answer[$counter]['msg'] =  "Вибачте, сталась помилка при завантаженні Вашого файла.";
                $answer[$counter]['type'] =  "error";
            }
        }

        return $answer;
    }

    public function filesAction()
    {
        return $this->render('admin/files.php',[
            'files' => Shingle::selectAllFinishedFiles()
        ]);
    }

    public function logsAction()
    {
        $result = [];

        if(file_exists('logs/' . date("d-m-Y") . '.txt'))
        {
            $logsForDay = file_get_contents('logs/' . date("d-m-Y") . '.txt');
            $rows = explode("\n", $logsForDay);

            $counter = 0;

            foreach ($rows as $row) {
                if (empty($row[0]))
                    continue;

                $twoElements = explode(" ] ", $row);
                $date = $twoElements[0];

                $title = explode(" : ", $twoElements[1])[0];
                $coincidence = explode(" : ", $twoElements[1])[1];

                $result[$counter]['date'] = $date;
                $result[$counter]['title'] = $title;
                $result[$counter]['coincidence'] = $coincidence;
                $counter++;
            }
        }

        return $this->render('admin/logs.php', [
            'logs' => $result
        ]);
    }

    public function changePassAction()
    {
        $answer = [];
        $counter = 0;

        if (isset($_POST['change_submit'])) {

            $oldPass = md5($_POST['old_pass']);
            $newPass = md5($_POST['new_pass']);
            $ConfirmPass = md5($_POST['confirm_new_pass']);

            if ($oldPass !== User::getPassword($_SESSION['user']['user_id'])) {
                $answer[$counter]['msg'] = "Неправильний старий пароль! Пароль не змінено.";
                $answer[$counter]['type'] = "error";
            }

            if ($newPass !== $ConfirmPass) {
                $answer[$counter]['msg'] = "Новий пароль не співпадає! Пароль не змінено.";
                $answer[$counter]['type'] = "error";
            }

            elseif ($oldPass == User::getPassword($_SESSION['user']['user_id']) && $newPass == $ConfirmPass) {

                User::setPassword($_SESSION['user']['user_id'], $newPass);

                $answer[$counter]['msg'] = "Пароль змінено.";
                $answer[$counter]['type'] = "ok";
            }

        }

        return $this->render('admin/changepass.php',[
            'answer' => $answer
        ]);
    }
}
