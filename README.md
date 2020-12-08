Описание хода мыслей (https://github.com/labushniak/exam-level-3/commits/master)
1. Добавил html-верстку в index.php - https://github.com/labushniak/exam-level-3/commit/5c3f3e9f013192831db375c46a74a0d055d38033

2. Добавил массив с данными и цикл foreach - https://github.com/labushniak/exam-level-3/commit/4dc243eb13d063f4461b5b666132ef5974443bf3

<<< Разработка компонента QueryBuilder >>>

3. Теперь нужно поместить данные в базу данных и оттуда их забирать, а затем выводить - https://github.com/labushniak/exam-level-3/commit/f7131bac2046d976afdda89bcc902fb9c3d19744

4. При создании соединения с базой данных возникло несколько ошибок из опечаток в настройках PDO. Для более удобной отладки создал обертку для var_dump(), чтобы вывод массивов и ошибок был в удобном формате. https://github.com/labushniak/exam-level-3/commit/c8c985dcbb66bff2fea2cbfcf71909a7a2ee7639

5. Проверил, что вывод не изменился. Все в порядке. Теперь я размышляю, что дальше по проекту мне нужно будет не только делать запрос выбора всех записей, но и ещё и нужно будет добавить функцию редактирования записи в базе данных, а также удаления. Причем при редактировании записи в базе данных мне нужно будет вывести данные только одной записи, а это ещё один запрос. 
Для этого я сделаю отдельный класс QueryBuilder, который будет отвечать только за запросы к базе данных. И начну я этот класс с переноса уже готового кода соединения с базой данных через PDO.
Создаю папку components, в нём создаю пустой файл QueryBuilder.php.
Далее подключаю файл QueryBuilder.php к файлу index.php. И вызываю функцию getAll() через создание объекта. Готово. https://github.com/labushniak/exam-level-3/commit/54551c4a1cf9a4d43301c4a20f864247d79dab30

6. Вызывать функцию getAll через создание объекта не очень удобно. Хотелось бы вызывать её без создания объекта. https://github.com/labushniak/exam-level-3/commit/02bc7a29ad67363abe6ec12d72ee142f4234fa0b

7. А если я буду использовать функцию getAll() не только с таблице posts, но и с другими таблицами. Хочу в функцию передавать название таблицы.
https://github.com/labushniak/exam-level-3/commit/1092c13159e653c3ed042d06a9cead2059b8d6e0

8. Теперь напишу фунцию getOne и создаю файл для редактирования поста edit.php. Копирую функцию getAll(), добавляю в ней WHERE id, исправляю имя и в результате получаю фунцию getOne. Вызываю ещё в новосозданном файле edit.php, но возникает ошибка подключения. Подключаю файл QueryBuilder.php и хочу проверить вывод через dd(). Но такой фунции не существует. Также выношу фунуцию dd() в качестве компонента Debug. Так как я не планирую расширять функционал отладки в рамках текущего проекта, то решаю оставить компонент в виде функции dd().
Подключаю файл Debug.php к index.php и edit.php. Проверяю, функция dd() выводит массив с постом с id=1.
https://github.com/labushniak/exam-level-3/commit/1f51a42ab3a590eb8475009468937741b72f7d63

9. После создания функции getOne вижу, что дублируются создания объекта PDO. Ведь можно сделать так, чтобы объект создавался один и автоматически. Для этого воспользуюсь паттерном singleton, чтобы объект PDO создавался только один раз. Но тогда обращение к методу getOne немного изменится. Метод я сделаю обычным и к нему будут обращаться через статичный метод getInstance().
https://github.com/labushniak/exam-level-3/commit/1f51a42ab3a590eb8475009468937741b72f7d63

10. Перехожу над работай с edit.php. Создаю html-шаблон формы на основе Bootstrap. Показ title для редактирования делается через перехват id в get-массиве. В свою очередь id попадает в get-массив после отправки с главной страницы.
На главное странице добавляю в ссылки id с данными из базы. В edit перехыватыю id и вывожу его в текстовое поле.
Теперь нужно написать функцию по редактированию title так, как мне хотелось бы её использоваться. Написал. Теперь перехожу в QueryBuilder и создаю функцию update.
Созадавая фунцию UPDATE понимаю, что если будет несколько значений, то лучше передавать массив данных для обновления. Для этого делаю, чтобы этот массив правильно обрабатывался и вставлялся, а SQL-строка получалась правильной. Ух, наконец-то заработало.
https://github.com/labushniak/exam-level-3/commit/3d06016cea8828334b3466952f6ffcf86751a878

11. Делаю фунционал создания постов. Для этого создаю страницу Add post на основе страницы edit.php. Пишу функцию update, как хочу ей пользоваться. Написал.
Перехожу в компонент QueryBuiler и пишу функцию insert. После мучений и исправлений ошибок функция все-таки заработала. Также поразмыслил и после создания фунции решил доработать её, чтобы можно было отправлять массив данных на случай, если придутся добавлять не только посты, но и другие данные, например, пользователей. После доработки функция стала немного более универсальной. Добавил переадресацию на главную страницу. Новые посты начали появляться.
https://github.com/labushniak/exam-level-3/commit/afc417f0bc3df47f00c390f73956b09cb5fd50d0

12. Теперь нужно сделать, чтобы посты можно было удалять. Для этого создаю страницу deletepost.php. Подключаю все необходимые файлы, прописываю функцию delete так, как хочу использовать. Затем перехожу в QueryBuilder и создаю функцию delete. Сделал.
https://github.com/labushniak/exam-level-3/commit/36e30281d42f0613c13aec4e7f36d5fcd9c70ccb

13. На текущем этапе QueryBuilder завершен, так как его функций достаточно для данного мини-проекта.
Документация к компоненту QueryBuilder:

array QueryBuilder::getInstance()->getAll($table = 'название таблицы, string') //возвращает все строки из таблицы

array QueryBuilder::getInstance()->getOne ($table= 'название таблицы, string', $id = 'идентификатор записи, тип int') //возвращает строку из таблицы с указанным id

boolean QueryBuilder::getInstance()->update ($table= 'название таблицы, string', $id = 'идентификатор записи, тип int', $data ='массив с данными для стобцов таблицы, array') //обновляет данные в строке таблицы с указанным id. Если добавил, то возвращает true

boolean QueryBuilder::getInstance()->insert ($table= 'название таблицы, string', $data ='массив с данными для стобцов таблицы, array') //добавляет строку с данными в таблицу, если добавил, то возвращает true

boolean QueryBuilder::getInstance()->delete ($table= 'название таблицы, string', $id = 'идентификатор записи, тип int') //удаляет строку из таблицу, если удалил, то возвращает true

https://github.com/labushniak/exam-level-3/commit/3d481a41477048b70ce509981d266383ce91e723

<<< Разработка компонента Validator >>>
14. Теперь нужно отфильтровать входящие данные с форм. В текущем проекте форм, принимаюющих данные 2: edit.php и addpost.php. Я хочу проверить входящие данные по title, чтобы с одной стороны пришедшая строка была не короче 2 символов, с другой - не длинее 100 символов. И обязательно была заполнена.

Для начала пропишу, как я хочу использовать компонент Validator в своем проекте, чтобы была ясность, как его реализовывать.
Задал для поля title правила: максимальное количество символов - 100, минимальное - 2, поле обязательно для заполнения.
Далее перехожу в компонент Validator и прописываю функцию проверки, а также дополнительные фунции вывода результата проверки и возвращения списка ошибок.
Если возникают ошибки, то они появляются в виде текста сверху страницы.
Валидатор работает.
