@extends("layout")
@section("content")
    <form action="/edit-genre/" method="post">
        <div>
            <input type="hidden" name="id" value="<?= $genre->id ?>">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>
                <div>Раздел</div>
                <select name="section">
                    <? foreach ($sections as $section): ?>
                    <option <?= $section->id == $genre->section->id ? "selected" : "" ?> value="<?= $section->id ?>"><?= $section->name ?></option>
                    <? endforeach ?>
                </select>
            </label>
        </div>

        <div>
            <label>
                <div>Название</div>
                <input type="text" name="name" value="<?= $genre->name ?>">
            </label>
        </div>

        <div>
            <label>
                <div>Описание</div>
                <input type="text" name="description" value="<?= $genre->description ?>">
            </label>
        </div>

        <button>Сохранить</button>
    </form>
@endsection
