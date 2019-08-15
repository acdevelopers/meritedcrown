<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RoleRequest.
 *
 * @package App\Http\Requests
 */
class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->isMethod('post')) {

            return $this->user()->can('create', Role::class);

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
                'name'          => ['required', 'string', 'max:30', 'unique:roles'],
                'title.en'      => ['required', 'string', 'max:30'],
                'title.fr'      => ['sometimes', 'max:30'],
                'level'         => ['required', 'integer'],
                'description'   => ['nullable', 'max:255']
            ];

        } elseif (request()->isMethod('put')) {

            return [
                'name'          => ['required', 'string', 'max:30'],
                'title.en'      => ['required', 'string', 'max:30'],
                'title.fr'      => ['sometimes', 'max:30'],
                'level'         => ['required', 'integer'],
                'description'   => ['nullable', 'max:255']
            ];

        }
    }
}
