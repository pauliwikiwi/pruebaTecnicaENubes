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
        $usuario = $userModel->getUserByMail($mail);

        // Verificar si el usuario existe
        if (!$usuario) {
            // Usuario no encontrado
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Correo electrónico o contraseña incorrectos.'
            ]);
        }

        // Verificar si el correo está confirmado
        if (!$usuario['confirmed_email']) {
            // Si el correo no está confirmado, impedir el login
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Por favor, confirma tu correo electrónico antes de iniciar sesión.'
            ]);
        }

        // Verificar la contraseña
        if (!password_verify($password, $usuario['password'])) {
            // Contraseña incorrecta
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Correo electrónico o contraseña incorrectos.'
            ]);
        }

        // Iniciar sesión: Guardar los datos del usuario en la sesión
        $session = session();
        $session->set([
            'usuario_id' => $usuario['id'],
            'usuario_nombre' => $usuario['name'] . ' ' . $usuario['last_name'],
            'usuario_email' => $usuario['email'],
            'logged_in' => true
        ]);

        // Retornar respuesta de éxito
        $response = [
            'success' => true,
            'redirect' => '/user/dashboard'  // Redirigir a la página de destino
        ];

        return $this->response->setJSON($response);

    }

    public function logout()
    {
        $session = session();
        $session->destroy(); // Elimina la sesión del usuario

        return redirect()->to('/'); // Redirige a la página de login o a donde desees
    }
}
