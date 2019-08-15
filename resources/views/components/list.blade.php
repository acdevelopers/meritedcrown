<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                @foreach($labels as $label)
                <th scope="col" {!! isset($label['width']) ? 'style="width: '.$label['width'].'"' : null !!}>
                    {{ $label['name'] }}
                </th>
                @endforeach
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach($nodes as $node)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>

                @foreach($fields as $field)
                <td>{{ $node->{$field} }}</td>
                @endforeach
                <td class="text-right">
                    <a href="{{ $node->present()->resourceUrl }}" class="btn btn-outline-info btn-sm tool-button">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="{{ $node->present()->resourceUrl('edit') }}" class="btn btn-outline-primary btn-sm tool-button">
                        <i class="fas fa-edit"></i>
                    </a>

                    <delete-button url="{{ $node->present()->resourceUrl('destroy') }}"></delete-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>