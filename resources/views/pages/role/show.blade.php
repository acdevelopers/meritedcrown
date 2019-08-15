@extends('layouts.page')
@section('page_title', $node->title)

@section('page_tools')
    @include('includes.roleTools')
@endsection

@section('content')
    @component('components.twoColumn')
        <div class="row mb-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $node->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Name: {{ $node->name }} | Level: {{ $node->level }}</h6>

                        <div>
                            {!! $node->description !!}
                        </div>

                        @can('update', $node)
                        <a href="{{ route('roles.edit', $node) }}" class="btn btn-outline-primary btn-sm tool-button">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan

                        @can('delete', $node)
                        <delete-button></delete-button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection