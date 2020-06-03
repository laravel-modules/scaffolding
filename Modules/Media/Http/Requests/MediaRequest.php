<?php

namespace Modules\Media\Http\Requests;

use Modules\Media\Rules\MediaRule;
use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'files' => ['required', 'array'],
            'files.*' => ['required', new MediaRule('image', 'video', 'audio', 'document')],
            'collection' => ['nullable', 'string'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
