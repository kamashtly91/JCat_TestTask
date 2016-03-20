JCat_TestTask
============
Для того чтобы развернуть проект:

 - создать БД
 - заполнить parameters.yaml
 - выполнить : php app/console doctrine:schema:create
 - выполнить sql запрос database/note.sql

Использование:
Получение списка новостей: https:server-domain.ru/list/{page}/{count}/{orderColumn}/{order}
 - page - номер страницы, целочисленное значение от 1
 - count - количество записей на странице, целочисленное значение от 1
 - orderColumn - столбец сортировки, значение title либо publish_date_time
 - order - тип сортировки, asc или desc
Получение одной новости: https:server-domain.ru/view/{id}
 - id - ид записи, целочисленное значение от 1