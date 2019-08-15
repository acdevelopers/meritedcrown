@component('components.tools')
    @can('create', \App\Role::class)
    <a class="dropdown-item" href="{{ route('roles.create') }}">
        <i class="fas fa-plus-square"></i> Add Role</a>
    @endcan
@endcomponent