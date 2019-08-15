<?php

namespace App\Http\Requests;

use App\Page;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PageRequest.
 *
 * @package App\Http\Requests
 */
class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->isMethod('post')) {

            return $this->user()->can('create', Page::class);

        } elseif (request()->isMethod('put')) {

            return true;

        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod('post')) {

            return [
                'title.en'          => ['required', 'string'],
                'title.fr'          => ['sometimes'],
                'body.en'           => ['required', 'string'],
                'body.fr'           => ['sometimes'],
                'weight'            => ['required', 'integer'],
                'published'         => ['required', 'boolean'],
                'meta_description'  => ['required', 'string', 'max:180'],
                'meta_keywords'     => ['required', 'string', 'max:180']
            ];

        } elseif (request()->isMethod('put')) {

            return [
                'title.en'          => ['required', 'string'],
                'title.fr'          => ['sometimes'],
                'body.en'           => ['required', 'string'],
                'body.fr'           => ['sometimes'],
                'weight'            => ['required', 'integer'],
                'published'         => ['required', 'boolean'],
                'meta_description'  => ['required', 'string', 'max:180'],
                'meta_keywords'     => ['required', 'string', 'max:180']
            ];

        }
    }
}
