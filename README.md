#миграции
php artisan migrate - установка миграций
php artisan make:migration NAME --create=TABLE_NAE - создание миграции
php artisan migrate:refresh - откат всех миграций и установка всех миграций

#модели
App\Example::all() - все записи <br>
php artisan make:model Example -mc  - создание модели с миграцией и контроллером

#БД

DB::table("TABLE_NAME")->get() - все записи
DB::table("TABLE_NAME")->find($id) - фильтр (видимо только по id)

#роуты
Route::get("/example/{id}", function ($id) {} - по get

#вью
view("example.index") - соответствует /views/example/index.blade.php

#контроллеры
php artisan make:controller NAME
