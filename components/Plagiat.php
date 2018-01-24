<?php

namespace components;

class Plagiat
{
    private $first_shingles;
    private $second_shingles;


    public function __construct($first = NULL, $second = NULL)
    {
        $this->first_shingles = $first;
        $this->second_shingles = $second;
    }

    public function get()
    {
        return $this->check_it($this->first_shingles, $this->second_shingles);

    }

    public function get_shingle($text,$n=3) {
        $shingles = array();
        $text = $this->clean_text($text);
        $elements = explode(" ",$text);
        for ($i=0;$i<(count($elements)-$n+1);$i++) {
            $shingle = '';
            for ($j=0;$j<$n;$j++){
                $shingle .= mb_strtolower(trim($elements[$i+$j]), 'UTF-8')." ";
            }
            if(strlen(trim($shingle)))
                $shingles[$i] = trim($shingle, ' -');
        }
        return $shingles;
    }

    private function clean_text($text) {
        $new_text = preg_replace("[\,|\.|\'|\"|\\|\/]","",$text);
        $new_text = preg_replace("[\n|\t]"," ",$new_text);
        $new_text = preg_replace('/(\s\s+)/', ' ', trim($new_text));
        return $new_text;
    }

    private function check_it($first, $second) {
        if (!$first || !$second) {
            echo "Отсутствуют оба или один из текстов!";
            return 0;
        }

        if (strlen($first)>200000 || strlen($second)>200000) {
            echo "Длина обоих или одного из текстов превысила допустимую!";
            return 0;
        }

        for ($i=1;$i<5;$i++) {
            $this->first_shingles = array_unique($this->get_shingle($first,$i));
            $this->second_shingles = array_unique($this->get_shingle($second,$i));

            if(count($this->first_shingles) < $i-1 || count($this->second_shingles) < $i-1) {
                echo "Количество слов в тексте меньше чем длинна шинглы<br />";
                continue;
            }

            $intersect = array_intersect($this->first_shingles,$this->second_shingles);

            $merge = array_unique(array_merge($this->first_shingles,$this->second_shingles));

            $diff = (count($intersect)/count($merge))/0.01;
            $result = round($diff, 2);

            return $result;
        }
    }

}