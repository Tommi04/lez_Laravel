<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMovieRequest extends FormRequest
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
            'name'          => 'required|required|max:255', //bail dovrebbe andare in errore al primo errore trovato, max:255 per dirgli o il valore massimo
            'film_code'     => 'required|max:100|regex:/^[M][0-9]{3}$/m|unique:laravel_movies,film_code,'.$this->adminmovie, 
            //per unique dobbiamo dirgli:sulla tabella movies alla colonna code. L'ultimo parametro significa che lo deve andare a prendere dal database
            'duration'      => 'required|numeric', //per testare che sia numerico
            'cover_path'    => 'required|max:255',
            'categories'    => 'required|array|min:1'
        ];
    }
    public function messages(){

        return [
            'required' => 'The :attribute field is required in update!!!!!!!',
        ];
    }
}
