<?php

namespace App\GraphQL\Validators\Mutation;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

final class UpdateCategoryValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
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
