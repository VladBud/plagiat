
<?error_reporting(E_ALL);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Сравнение текстов на схожесть - алгоритм шинглов - уникальный контен - реврайт</title>
    <meta name="keywords" content="Сравнение, текстов, схожесть, уникальный, контен, реврайт, алгоритм шингл" />
    <meta name="description" content="Данный сервис позволяет сравнить два текста на уникальность после изменений." />
    <meta name="robots" content="index, follow" />
</head>
<body style="font-family: Tahoma;">

<div id="container" style="margin: 0 auto; width: 95%;">

    <h1 align="center">Сравнение текстов на схожесть</h1>
    <div style="float: left; clear: none; width: 48%;">
        Зачем изобретать велосипед?<br />
        Поискал нужный текст или статью и скопировал себе на сайт.
        Но не все так просто. Думаю вы слышали о том, что лучше делать <strong>уникальный контен сайта</strong>.
        <p>
            Что может произойти если поисковик <a href="http://google.com" target="_top">Google</a> или <a href="http://yandex.ru" target="_top">Яндекс</a> определит, что ваш текст
            "позаимствован" с другого сайта?<br />
            Ваш ресурс может не попасть в результаты поиска.
        </p>
        <p>
            Как же поисковые машины определяют схожесть текстов?<br />
            Существует "<strong>алгоритм шинглов</strong>" (shingles-Шинглы), позволяющий простой <strong>проверкой
                двух текстов</strong> убедиться, что между ними есть связь.
        </p>
        <p>
            Как работает "<strong>алгоритм шингл</strong>"?<br />
            Разбиение текстов на слова, а затем сравнение полученных матриц. Так что, становиться
            не важно если вы просто переставили слова или предложения (если деление идет на 1 слово).
            Разбиение текста может быть как по одному слову, так и по несколько, т.e. шингла из нескольких слов.
        </p>
        <p>
            Данный сервис позволяет сравнить два текста на уникальность после изменений.
        </p>
        <p>
            Для проверки вам необходим оригинал текста и переделанная (реврайт) копия.
        </p>
        <p>
            Идея взята с сайта "Тексторубка" (http://textorubka.ru/test.php).<br />
            Код (PHP) был написан с нуля, но после того, как был найден более красивый код, был заменен на него
            с моими вставками.
        </p>
        <p>
            Версия: 1.0<br />
            <a href="/shingles_php.rar">PHP код алгоритм шинглов</a>
        </p>
        <p>
            <a href="http://rikuz.com/seo/">Создание оригинальных текстов и Раскрутка сайтов</a>
        </p>
    </div>
    <div style="float: right; width: 48%;">
        Перед сравнением текст проходит минимальные чистки и изменения:<br />
        - убираются html вставки такие как &lt;strong&gt;<br />
        - символы преобразуются в нижний регистр<br />
        - убираются запятые, точки, апострофы, знаки переноса строки, двойные пробелы, слешы.<br />
        <br />

        <form enctype="multipart/form-data" method="post" action="/">
            <strong>Оригинальный текст</strong>:<br />
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br />
            <input type="submit" name="submit" value="Проверить" style="display: block; margin: 0 auto; font-weight: bold; width: 50%;" />
        </form>
        <p>
            <?= $result ?? '' ?>
</div>

</body>
</html>
