<?php
require_once  'models/conf.php';
require_once  'models/model.php';

// подгружаем и активируем авто-загрузчик Twig-а
require_once 'Twig/Autoloader.php';

Twig_Autoloader::register();



try {
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');
  
  // инициализируем Twig
  $twig = new Twig_Environment($loader);
  
  // подгружаем шаблон
  $template = $twig->loadTemplate('index.tmpl');
  
  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  $images = getAllPictures($conn);
  $imagesToTemplate = prepareArray($images);
  $content = $template->render(array(
    'images'=> $imagesToTemplate 
  ));
  echo $content;
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>