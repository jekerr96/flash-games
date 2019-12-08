@extends("layout")
@section("content")
    <div class="container">
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
                    <?= request()->get("q") ? "По вашему запросу ничего не найдено" : "Вы пока не играли ни в одну игру" ?>
                </div>
                <? endif; ?>
        </div>

        {{ $items->appends(request()->input())->links() }}
    </div>
@endsection
