# Стартовая тема основанная на _s (A Starter Theme for WordPress)

См.
- [github](https://github.com/automattic/_s)
- [_s](https://underscores.me/)

Описание
---------------

Заточенно под определенный рабочий процесс. Используется для разработки тем. Постоянно дополняется для более удобной и быстрой работы с часто используемыми модулями на сайтах.

Компилляция идет с помощью отдельной 'темы' `gulp-dev`:
- [См. репозиторий](https://github.com/imicra/gulp-dev)

### Начало работы

Вариант для добавления темы в готовую установку WP, используя `WP-CLI`

* Добавить тему: `git clone https://github.com/imicra/imicra-constructor.git` или скачать
* `wp-config.php` прописать новую БД `DB_NAME`
* В терминале перейти в директорию с установленным WP
* `wp db create`
* `wp core install --url=wpclidemo.dev --title="WP-CLI" --admin_user=wpcli --admin_password=wpcli --admin_email=info@wp-cli.org`
* В терминале перейти в директорию с темой
* `composer install`
* В терминале перейти в директорию с темой в `src/libs`
* `npm install`
* В терминале перейти в директорию с 'темой' для сборки проекта `gulp-dev` ([с предварительно заданным `themename`](https://github.com/imicra/gulp-dev))
* `gulp`

### Компилляция

* `style.css` для задания темы
* В папке `sass` вся работа со стилями
* В папке `js` главный файл - `main.js`
* В папку `src` скидываются все плагины jQuery/js и т.п. А также в папке `img` находится `svg-icons.svg` для всех иконок, которые используются отдельно, как картинки svg. В `sass` лежат bootstrap 4 и fontawesome.
* Все это компилируется в папку `assets`. Из src под названием `libs.min.css` и `libs.min.js`

### Файлы

* Вся настройка в functions.php. Там же подключаются файлы из папки `inc`. Изначально подключены не все, а подключаются в процессе разработки по мере необходимости.
* Папка `inc` содержит файлы с кастомными функциями и расширениями стандартного функционала.

### inc

* Плагин `customizer-repeater` для Customizer.
* Файл `custom-styles.php` создает css в head, управляемые в Customizer.
* Файл `icon-functions.php` для вставки svg в код и создания меню.
* Файл `bootstrap-walker-nav-menu.php` для стандартного меню из bootstrap.
* Файл `custom-walker-nav-menu.php` для создания нового Walker_Nav_Menu.
* Файл `theme-functions.php` с кастомными функциями.
* Папка `cpt` для Custom Post Types.
* Папка `admin` для расширения функционала админки. Изначально создает раздел меню для настроек темы.
* Файл `woocommerce.php` с начальными настройками для подключения в тему Woocommerce.

### crb-builder

* coming soon
