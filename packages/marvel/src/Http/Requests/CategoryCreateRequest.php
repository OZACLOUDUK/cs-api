<?php


namespace Marvel\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => ['required', 'string'],
            'slug'         => ['nullable', 'string'],
            // 'type_id'   => ['required', 'integer'],
            'icon'         => ['nullable', 'string'],
            'image'        => ['array'],
            'banner_image' => ['array'],
            'details'      => ['nullable', 'string'],
            'language'     => ['nullable', 'string'],
            'parent'       => ['nullable', 'integer'],
        ];
    }

    /**
     * Get the error messages that apply to the request parameters.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'       => 'Name field is required',
            'name.string'         => 'Name is not a valid string',
            'name.max:255'        => 'Name can not be more than 255 character',
            'icon.string'         => 'Icon is not a valid string',
            'image.string'        => 'Image is not a valid image',
            'banner_image.string' => 'Banner image is not a valid image',
            'details.string'      => 'Details is not a valid string',
            'parent.integer'      => 'Parent is not a valid integer',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
