<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
                'productName' => 'required|string|max:255',
                'companyName' => 'required|string|max:255',
                'price' => 'required|integer|min:0', 
                'stock' => 'required|integer|min:0',
                'comment' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }

    public function messages() {
        return [
            'productName.required' => '商品名は必ず入力してください。',
            'companyName.required' => '企業名は必ず入力してください。',
            'price.required' => '価格は必ず入力してください。',
            'price.integer' => '価格は半角数字で入力してください。',
            'price.min' => '価格は0以上の数字を入力して下さい。',
            'stock.required' => '在庫数は必ず入力してください。',
            'stock.integer' => '在庫数は半角数字で入力してください。',
            'stock.min' => '在庫数は0以上の数字を入力して下さい。',
            'comment.max' => 'コメントは255文字以内で入力して下さい。',
            'image.max' => '画像ファイルのサイズは1MB以下にしてください。',
            'image.mimes' => '画像ファイルの形式はjpeg、pngのいずれかを選択してください。',
        ];
    }
    public function storeProduct() {
        $validatedData = $this->validated();
    }
}
