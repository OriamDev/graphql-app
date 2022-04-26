<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class CategoryUpdateInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required'
            ],
            'name' => [
                'sometimes',
                Rule::unique('categories', 'name')->ignore($this->arg('id'), 'id'),
            ],
        ];
    }
}
