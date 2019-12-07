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
        </div>

        {{ $items->links() }}
    </div>
@endsection
