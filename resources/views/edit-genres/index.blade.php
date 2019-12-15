@extends("layout")
@section("content")
    <? foreach ($genres as $genre): ?>
        <div class="js-genre">
            <span class="section-name"><?= $genre->section->name ?> / </span>
            <a target="_blank" href="<?= $genre->getUrl() ?>" class="genre-name"><?= $genre->name ?></a>
            <a href="/edit-genre/<?= $genre->id ?>" class="edit">Изменить</a>
            <span class="delete js-delete-genre" data-id="<?= $genre->id ?>">Удалить</span>
        </div>
    <? endforeach; ?>
@endsection
