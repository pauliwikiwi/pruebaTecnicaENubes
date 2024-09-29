<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function authenticate()
    {
        // Instancia del modelo
        $userModel = new User();

        // Obtener los datos del formulario
        $request = \Config\Services::request();
        $mail = $request->getPost('mail');
        $password = $request->getPost('password');

        // Buscar el usuario por su nombre de usuario
        $user = $userModel->getUserByMail($mail);

        // Verificar si el usuario existe
        if ($user) {
            // Verificar si la contraseña ingresada coincide con la almacenada (usando hash)
            if (password_verify($password, $user['password'])) {
                // Contraseña correcta, iniciar sesión
                $response = [
                    'success' => true,
                    'redirect' => '/dashboard'  // Redirigir a la página de destino
                ];
            } else {
                // Contraseña incorrecta
                $response = [
                    'success' => false,
                    'message' => 'Invalid username or password.'
                ];
            }
        } else {
            // Usuario no encontrado
            $response = [
                'success' => false,
                'message' => 'Invalid username or password.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
