<?php

require_once(ROOT . '/components/Plagiat.php');
require_once(ROOT . '/components/DocxConversion.php');

require_once(ROOT . '/models/Shingle.php');


class IndexController {

    public function IndexAction()
    {
        if(isset($_POST["submit"])) {
            $file = $this->uploadFile();
            print_r('FILE IS: ' . $file);

            $allFiles =  Shingle::selectAllFiles();
            $singleFile = Shingle::selectFile($file);
            print_r( $singleFile);

            $file1 = new DocxConversion($singleFile);
            $text1 = ($file1->convertToText());


            $results = [];

            foreach ($allFiles as $files)
            {
                $file2 = new DocxConversion($files);
                //print_r($file2->convertToText());
                $result = new Plagiat($file2->convertToText(), $file1->convertToText());
                array_push($results, $result->get());
            }

//              $finish = round(array_sum($results)/ count($results), 2);
                $finish = max($results);
        }


        require_once(ROOT . '/views/main/main.php');
        return true;
    }

    private function uploadFile()
    {
        $continue = true;
        $target_dir = "temp/";
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
            echo "Sorry, your file was not uploaded.";
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

                echo "The file ". $_FILES["fileToUpload"]["name"]. " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        return $text_id;
    }
}
