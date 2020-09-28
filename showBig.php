<?php
require_once  'models/conf.php';
require_once  'models/model.php';
// подгружаем и активируем авто-загрузчик Twig-а
require_once 'Twig/Autoloader.php';

Twig_Autoloader::register();


if (isset($_GET['id'])){
    
    try {
    // указывае где хранятся шаблоны
    $loader = new Twig_Loader_Filesystem('templates');
    
    // инициализируем Twig
    $twig = new Twig_Environment($loader);
    
    // подгружаем шаблон
    $template = $twig->loadTemplate('showBig.tmpl');
    
    // передаём в шаблон переменные и значения
    // выводим сформированное содержание

    $photoID = $_GET['id'];

    $source="img/big/".getPhotoNameByID($photoID,$conn);
    
    
    $content = $template->render(array(
        'source'=> $source
    ));
    echo $content;
    
    } catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
    }
}
?>