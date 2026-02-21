<?php

namespace Src\Cliente\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $userId = $this->userId ?? $this->user_id;
        if (is_array($userId)) {
            $userId = $userId['value'] ?? $userId['id'] ?? null;
        }

        $this->merge([
            'user_id' => $userId,
            'tipo_documento' => $this->tipoDocumento ?? $this->tipo_documento,
            'numero_documento' => $this->numeroDocumento ?? $this->numero_documento,
            'razon_social' => $this->razonSocial ?? $this->razon_social,
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|uuid|exists:users,id|unique:clientes,user_id',
            'tipo_documento' => 'nullable|string|in:DNI,RUC,CE,PASAPORTE',
            'numero_documento' => 'nullable|string|unique:clientes,numero_documento',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'usuario',
            'tipo_documento' => 'tipo de documento',
            'numero_documento' => 'numero de documento',
            'razon_social' => 'razon social',
            'direccion' => 'direccion',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El usuario es obligatorio',
            'user_id.exists' => 'El usuario seleccionado no existe',
            'user_id.unique' => 'Este usuario ya tiene un cliente asignado',
            'tipo_documento.required' => 'El tipo de documento es obligatorio',
            'tipo_documento.in' => 'El tipo de documento debe ser DNI, RUC, CE o PASAPORTE',
            'numero_documento.required' => 'El numero de documento es obligatorio',
            'numero_documento.unique' => 'Este numero de documento ya esta registrado',
            'razon_social.required' => 'La razon social es obligatoria',
            'direccion.required' => 'La direccion es obligatoria',
        ];
    }
}
