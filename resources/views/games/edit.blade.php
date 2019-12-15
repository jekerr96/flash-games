@extends("layout")
@section("content")
    <div class="container">
        <form action="/edit-game/" method="post">
            <div>
                <input type="hidden" name="id" value="<?= $game->id ?>">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a target="_blank" class="link-to-game" href="<?= $game->getUrl() ?>">Ссылка на игру</a>
                <label>
                    <div>Жанры</div>
                    <select name="genres[]" multiple>
                        <? foreach ($genres as $genre): ?>
                        <option <?= $game->genres->contains("id", $genre->id) ? "selected" : "" ?> value="<?= $genre->id ?>"><?= $genre->name ?></option>
                        <? endforeach ?>
                    </select>
                </label>
            </div>

            <div>
                <label>
                    <div>Название</div>
                    <input type="text" name="name" value="<?= $game->name ?>">
                </label>
            </div>

            <div>
                <label>
                    <div>Описание</div>
                    <textarea type="text" name="description"><?= $game->description ?></textarea>
                </label>
            </div>

            <div>
                <label>
                    <div>Картинка</div>
                    <input type="text" name="image" value="<?= $game->image ?>">
                    <img class="image" src="<?= $game->image ?>" alt="">
                </label>
            </div>

            <div>
                <label>
                    <div>Код игры</div>
                    <textarea type="text" name="html"><?= $game->html ?></textarea>
                </label>
            </div>

            <button>Сохранить</button>
        </form>
    </div>
@endsection
