@extends('layouts.page')
@section('page_title')
    @if (isset($node))
        {{ 'Editing > ' . $node->title }}
    @else
        {{ 'Create Page' }}
    @endif
@endsection

@section('page_tools')
    @include('includes.pageTools')
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
                <form method="post" action="{{ isset($node) ? $node->present()->resourceUrl('update') : route('pages.store') }}">
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
                                <label for="inputBodyEN">Body (English)</label>
                                <textarea class="form-control @error('body.en') is-invalid @enderror" name="body[en]"
                                          id="inputBodyEN"
                                          placeholder="Body (English)">{{ old('body.en') ?: (isset($node) ? $node->getTranslation('body', 'en') : null) }}</textarea>

                                @error('body.en')
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
                                <label for="inputBodyFR">Body (French)</label>
                                <textarea class="form-control @error('body.fr') is-invalid @enderror" name="body[fr]"
                                          id="inputBodyFR" placeholder="Body (French)">{{ old('body.fr') ?: (isset($node) ? $node->getTranslation('body', 'fr') : null) }}</textarea>

                                @error('body.fr')
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
                                <label for="inputWeight">Weight</label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" name="weight"
                                       id="inputWeight" placeholder="Weight"
                                       value="{{ old('weight') ?: (isset($node) ? $node->weight : null) }}">
                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group m-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published" id="inputPublished1" value="1" checked>
                                    <label class="form-check-label" for="inputPublished1">
                                        Publish
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('published') is-invalid @enderror" type="radio" name="published" id="inputPublished2" value="0">
                                    <label class="form-check-label" for="inputPublished2">
                                        Un-publish
                                    </label>
                                </div>

                                @error('published')
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
                                <label for="inputMetaDescription">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror" name="meta_description"
                                          id="inputMetaDescription" placeholder="Meta Description">{{ old('meta_description') ?: (isset($node) ? $node->meta_description : null) }}</textarea>

                                @error('meta_description')
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
                                <label for="inputMetaKeywords">Meta Keywords</label>
                                <textarea class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
                                          id="inputMetaKeywords" placeholder="Meta Keywords">{{ old('meta_keywords') ?: (isset($node) ? $node->meta_keywords : null) }}</textarea>

                                @error('meta_keywords')
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

@push('scripts')
    <script>
        InlineEditor.create( document.querySelector( '#inputBodyEN' ) );
        InlineEditor.create( document.querySelector( '#inputBodyFR' ) );
    </script>
@endpush

@push('stylesheets')
    <style>
        .ck-content {
            height: 300px;
        }
    </style>
@endpush