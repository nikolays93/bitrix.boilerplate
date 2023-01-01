# Примеры реализации модулей 1C:Битрикс

https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=101&INDEX=Y

### Правила автозагрузки классов модуля

Файлы классов должны именоваться в нижнем регистре, при этом название класса равно название файла.  
`Пример`: /lib/myclass.php.  
Файлы должны содержать правильный namespace.  
`Пример`: если модуль подключается как: Loader::includeModule('company.shotname'); то в классе должен быть прописан namespace: namespace Company\Shotname.  
