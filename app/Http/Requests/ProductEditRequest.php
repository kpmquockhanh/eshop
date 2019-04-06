<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEditRequest extends FormRequest
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
            'name' => 'required',
//            'show' => 'required',
            'saleoff' => 'min:0|max:1|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required',
//            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'price.required' => 'Vui lòng nhập giá',
            'price.numeric' => 'Vui lòng nhập đúng định dạng',
            'saleoff.min' => 'Giảm giá tối thiểu là 0',
            'saleoff.max' => 'Giảm giá tối đa là 1',
            'quantity.required' => 'Vui lòng nhập số lượng',
            'image.required' => 'Vui lòng chọn ảnh minh họa sản phẩm',
        ];
    }
}
