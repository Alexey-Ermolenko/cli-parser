# test-task

## html-parser

PHP парсер html страницы (на входе url), 
который на выходе будет отображать количество 
и название всех используемых html тегов.

1. <code>docker-compose up</code>
2. <code>docker exec -ti html-parserlocal-phpfpm-1 /bin/sh</code>


### How it works
После подключения к контейнеру phpfpm вам следует запустить php скрипт с 2 параметрами
такими как<br/>
<code>-p</code> - это может быть как url так и путь к файлу на сервере<br/>
<code>-d</code> - способ отображения данных

Examples:

1. <code>php public/index.php -p=test.html -d=cli</code>
1. <code>php public/index.php -p=test.html -d=html</code>
1. <code>php public/index.php -p=https://www.example.com/ -d=json</code>