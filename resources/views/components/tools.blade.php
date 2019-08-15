@auth
    <div class="dropdown">
        <a class="btn btn-outline-secondary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-gear"></i> Tools
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            {{ $slot }}
        </div>
    </div>
@endauth