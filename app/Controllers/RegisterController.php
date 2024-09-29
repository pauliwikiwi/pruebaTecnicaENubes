<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('auth/register');
    }

    public function save()
    {
        // Instancia del modelo de usuario
        $userModel = new User();

        // Obtener los datos del formulario
        $request = \Config\Services::request();
        $nombre = $request->getPost('name');
        $apellidos = $request->getPost('lastname');
        $correo = $request->getPost('mail');
        $password = $request->getPost('password');


        // Validar si el correo ya existe
        $existingUser = $userModel->where('email', $correo)->first();
        if ($existingUser) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'El correo ya está registrado.'
            ]);
        }

        // Hashear la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Guardar los datos del nuevo usuario en la base de datos
        $userModel->save([
            'name' => $nombre,
            'last_name' => $apellidos,
            'email' => $correo,
            'password' => $hashedPassword  // Guardar la contraseña hasheada
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Usuario registrado correctamente.'
        ]);
    }
}
