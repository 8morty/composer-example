<?php

namespace eightmorty\parser;

class Parser implements ParserInterface {

    public function process(string $tag, string $url): array {

        //  Массив для записи результатов
        $tagsText = array();
        //  Получаем содержимое сайта в строку
        $htmlPage = file_get_contents($url);
                    
        //	Regular expression
        
        /*
         * более хорошим вариантом будет написать вместо точки конструкцию [^>] (не закрывающий уголок), вот так - <body[^>]*?> - в этом случае мы полностью застрахуем себя от проблем такого рода, так как регулярка никогда не сможет выйти за тег.
         * Если попытаться спарсить многострочный тег - у вас ничего не получится, пока вы не включите однострочный режим с помощью модификатора s
         * Для работы с кириллицей - нужно написать модификатор u 
         */
        preg_match_all('#<' . $tag . '[^>]*?>(.*?)</' . $tag . '>#su', $htmlPage, $tagsText);

        return $tagsText;
    }

    public function test() {
        //  feature
    }
}

