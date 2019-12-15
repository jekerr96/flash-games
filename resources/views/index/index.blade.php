@extends("layout")
@section("content")
    <div class="container">
        <div class="content-wrapper">
            <? if (isset($genres)): ?>
            <div class="genres-wrapper">
                <? foreach ($genres as $genre): ?>
                <? $current = $genre->id == $tag; ?>
                <a class="genre-item<?= $current ? " active" : "" ?>" href="<?= $current ? $genre->section->getUrl() : $genre->getUrl() ?>"><?= $genre->name ?></a>
                <? endforeach; ?>
            </div>
            <? endif; ?>
            <div class="list-games">
                <? foreach ($items as $item): ?>
                    @include("partials.game-item")
                <? endforeach ?>
                <? if ($items->isEmpty()): ?>
                <div class="empty-wrapper">
                    По вашему запросу ничего не найдено
                </div>
                <? endif; ?>
            </div>
        </div>
        {{ $items->appends(request()->input())->links() }}
    </div>
@endsection
