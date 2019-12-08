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
                <div class="game-item" data-aos="flip-up">
                    <a href="/game/<?= $item->id ?>">
                        <span class="game-image" style="background-image: url('<?= $item->image ?>')"></span>
                        <span class="game-name"><?= $item->name ?></span>
                    </a>
                </div>
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
