@extends("layout")
@section("content")
    <div class="container">
        <form action="/edit-game/" method="post">
            <div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>
                    <div>Жанры</div>
                    <select name="genres[]" multiple>
                        <? foreach ($genres as $genre): ?>
                        <option value="<?= $genre->id ?>"><?= $genre->name ?></option>
                        <? endforeach ?>
                    </select>
                </label>
            </div>

            <div>
                <label>
                    <div>Название</div>
                    <input type="text" name="name">
                </label>
            </div>

            <div>
                <label>
                    <div>Описание</div>
                    <textarea type="text" name="description"></textarea>
                </label>
            </div>

            <div>
                <label>
                    <div>Картинка</div>
                    <input type="text" name="image">
                </label>
            </div>

            <div>
                <label>
                    <div>Код игры</div>
                    <textarea type="text" name="html"></textarea>
                </label>
            </div>

            <button>Сохранить</button>
        </form>
    </div>
@endsection
