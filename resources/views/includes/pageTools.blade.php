@component('components.tools')
    @can('create', \App\Page::class)
    <a class="dropdown-item" href="{{ route('pages.create') }}">
        <i class="fas fa-plus-square"></i> Add Page</a>
    @endcan
@endcomponent