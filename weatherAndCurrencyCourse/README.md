<ul>Требования Laravel</ul>
<li>PHP >= 7.2.5</li>
<li>BCMath PHP Extension</li>
<li>Ctype PHP Extension</li>
<li>Fileinfo PHP extension</li>
<li>JSON PHP Extension</li>
<li>Mbstring PHP Extension</li>
<li>OpenSSL PHP Extension</li>
<li>PDO PHP Extension</li>
<li>Tokenizer PHP Extension</li>
<li>XML PHP Extension</li>
<li>Еще требование (мы установили зачем-то sqlite в проект) pdo_sqlite(кажется так называется расширение php, которое нужно установить)</li>

<code>$ make setup</code> - для установки пакетов и наката миграций<br>
<code>$ make start</code> - для запуска веб-сервера<br>

Переменные окружения для api прятать не стал, хотя надо бы, но раз задание тестовое, то пойдет (наверное)
