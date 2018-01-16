<?php

require_once(ROOT . '/components/Plagiat.php');
require_once(ROOT . '/components/DocxConversion.php');

require_once(ROOT . '/models/Shingle.php');


class IndexController {

    public function IndexAction()
    {
//        chmod('/var/www/project.loc/public_html/uploads/PRAK.doc', 777);
        shell_exec('catdoc /var/www/project.loc/public_html/uploads/PRAK.doc > /var/www/project.loc/public_html/uploads/PRAK.docx' );

        if(isset($_POST["submit"])) {

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

// Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
// Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
// Allow certain file formats
            if($imageFileType != "docx" && $imageFileType != "doc") {
                echo "Sorry, only DOC, DOCX files are allowed.";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }



            $docx = new DocxConversion($target_file, $_FILES["fileToUpload"]["name"]);
            print_r($docx->convertToText());

        }

//        if (isset($_POST['text1']) && isset($_POST['text2'])) {
//            $r = new Plagiat(strip_tags($_POST['text1']), strip_tags($_POST['text2']));
//            $result = $r->get();
//        }

        print_r(Shingle::getShingles());
        require_once(ROOT . '/views/main/main.php');
        return true;
    }

    public function readWord($filename) {
        if(file_exists($filename))
        {
            if(($fh = fopen($filename, 'r')) !== false )
            {
                $headers = fread($fh, 0xA00);

                // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
                $n1 = ( ord($headers[0x21C]) - 1 );

                // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
                $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

                // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
                $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

                // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
                $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

                // Total length of text in the document
                $textLength = ($n1 + $n2 + $n3 + $n4);

                $extracted_plaintext = fread($fh, $textLength);

                // if you want to see your paragraphs in a new line, do this
                // return nl2br($extracted_plaintext);
                return $extracted_plaintext;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
