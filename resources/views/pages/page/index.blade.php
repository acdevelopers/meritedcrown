@extends('layouts.page')
@section('page_title', 'Pages')

@section('page_tools')
    @include('includes.pageTools')
@endsection

@section('content')
    @component('components.twoColumn')
        @component('components.list', [
                'nodes' => $nodes,
                'labels' => [
                    [
                        'name' => 'Title',
                        'width' => '50%'
                    ],
                    [
                        'name' => 'Published',
                        'width' => '5%'
                    ],
                ],
                'fields' => ['title', 'is_published']
            ])
        @endcomponent

    @endcomponent
@endsection