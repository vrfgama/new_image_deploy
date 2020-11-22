<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        $extension= '.'.$value->getClientOriginalExtension();
        $originalName= $value->getClientOriginalName();
        $newName= str_replace($extension, '', $originalName);  

        return is_numeric($newName);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Há arquivo que não esta nomeado com image_id';
    }
}
