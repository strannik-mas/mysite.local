<?php
if(!$news->getNews()){
    $errMsg = "Произошла ошибка при выводе новостной ленты";
    header("Location: news.php");
}
elseif(!empty($globalArr = $news->getNews())){
//    var_dump ($newsArr);
    foreach ($globalArr as $newsArr){
        $date = date("d/m H:i", $newsArr['datetime']);
        echo <<<LABEL
        <h3>{$newsArr['title']}</h3>
        <p>Категория: {$newsArr['category']}</p>
        <p>Новость добавлена в : {$date}</p>
        <article>{$newsArr['description']}</article>
        <div class="link"><a href="{$newsArr['source']}">Подробнее</a><a href="news.php?id={$newsArr['id']}" style="float:right;">Удалить</a></div>
LABEL;
    }
    
}
else $errMsg = "Произошла ошибка при выводе новостной ленты";