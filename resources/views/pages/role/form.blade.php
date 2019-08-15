@extends('layouts.page')
@section('page_title')
    @if (isset($node))
        {{ 'Editing > ' . $node->title }}
    @else
        {{ 'Create Role' }}
    @endif
@endsection

@section('page_tools')
    @include('includes.roleTools')
@endsection

@section('content')
    @component('components.twoColumn')
        <div class="card">
            @if (isset($node))
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('view', $node)
                        <a href="{{ $node->present()->resourceUrl }}" class="btn btn-outline-primary btn-sm tool-button mr-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    @endcan

                    @can('delete', $node)
                        <delete-button url="{{ $node->present()->resourceUrl('destroy') }}"></delete-button>
                    @endcan
                </div>
            </div>
            @endif
            <div class="card-body">
                <form method="post" action="{{ isset($node) ? route('roles.update', $node) : route('roles.store') }}">
                    @csrf
                    @if (isset($node))
                        @method('PUT')
                    @endif

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inputTitleEN">Title [EN]</label>
                                <input type="text" class="form-control @error('title.en') is-invalid @enderror" name="title[en]"
                                       id="inputTitle" placeholder="Title in English"
                                       value="{{ old('title.en') ?: (isset($node) ? $node->getTranslation('title', 'en') : null) }}">
                                @error('title.en')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputTitleFR">Title [FR]</label>
                                <input type="text" class="form-control @error('title.fr') is-invalid @enderror" name="title[fr]"
                                       id="inputTitleFR" placeholder="Title in French"
                                       value="{{ old('title.fr') ?: (isset($node) ? $node->getTranslation('title', 'fr') : null) }}">
                                @error('title.fr')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       id="inputName" placeholder="Name"
                                       value="{{ old('name') ?: (isset($node) ? $node->name : null) }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputLevel">Level</label>
                                <input type="number" class="form-control @error('level') is-invalid @enderror" name="level"
                                       id="inputLevel" placeholder="Level"
                                       value="{{ old('level') ?: (isset($node) ? $node->level : null) }}">
                                @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                          id="inputDescription" placeholder="Description">{{ old('description') ?: (isset($node) ? $node->description : null) }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    @endcomponent
@endsection