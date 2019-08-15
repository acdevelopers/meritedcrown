@extends('layouts.page')
@section('page_title', $node->title)
@section('meta_description', $node->meta_description)

@section('page_tools')
    @include('includes.pageTools')
@endsection

@section('content')
    @component('components.twoColumn')
        <div class="row">
            <div class="col">
                <div class="card">
                    @can('edit', $node)
                        <div class="card-header">
                            <div class="d-flex justify-content-end">
                                @can('update', $node)
                                <a href="{{ $node->present()->resourceUrl('edit') }}" class="btn btn-outline-primary btn-sm tool-button mr-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan

                                @can('delete', $node)
                                <delete-button url="{{ $node->present()->resourceUrl('destroy') }}"></delete-button>
                                @endcan
                            </div>
                        </div>
                    @endcan

                    <div class="card-body">
                        {!! $node->body !!}
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection