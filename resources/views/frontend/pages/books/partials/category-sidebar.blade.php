<div class="list-group mt-3">
    @foreach (App\Models\Category::all() as $cat)
    <a href="{{ route('books.index',$cat->slug) }}" class="list-group-item list-group-item-action">
        {{ $cat->name }}
        </a>
    @endforeach


</div>
