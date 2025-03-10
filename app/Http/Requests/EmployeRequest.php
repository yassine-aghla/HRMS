<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;
class EmployeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            
            'contrat_id' => 'exists:contrats,id',
            'department_id' => 'exists:departments,id',
            'emploi_id' => 'exists:emplois,id',
            'grade_id' => 'exists:grades,id',
            'user_id'=>'exists:users,id',
    
            // Validation pour le champ 'salaire'
             'salaire' => 'required|numeric|min:1000|max:100000', // Valeur numérique, entre 1000 et 100000
    
            // Validation pour le champ 'phone'
            'phone' => 'nullable|string|regex:/^\+?[0-9]{10,15}$/', // Optionnel, et doit correspondre à un format de numéro de téléphone
    
            // Validation pour le champ 'photo'
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optionnel, et doit être une image avec les extensions spécifiées et taille max de 2MB
             'role' => 'required|string|exists:roles,name',
             'date_embauche' => 'required|date',
             'solde_recuperation' => 'nullable|integer|min:0',

            // Validation pour le champ 'formations'
            'formations' => 'nullable|array', 
            'formations.*' => 'exists:formations,id', 
        ];
    }
    
}
