<?php

namespace TypiCMS\Modules\Projects\Http\Requests;

use TypiCMS\Modules\Core\Custom\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'category_id' => 'required',
            'date'        => 'date',
            'website'     => 'url|max:255',
            '*.title'     => 'max:255',
            '*.slug'      => 'alpha_dash|max:255',
        ];
    }
}
