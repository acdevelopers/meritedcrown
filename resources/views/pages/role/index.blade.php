@extends('layouts.page')
@section('page_title', 'Roles')

@section('page_tools')
    @include('includes.roleTools')
@endsection

@section('content')
    @component('components.twoColumn')
        @component('components.list', [
                'nodes' => $nodes,
                'labels' => [
                    [
                        'name' => 'Level',
                        'width' => '5%'
                    ],
                    [
                        'name' => 'Title'
                    ],
                    [
                        'name' => 'Name'
                    ],
                ],
                'fields' => ['level', 'title', 'name']
            ])
        @endcomponent

    @endcomponent
@endsection