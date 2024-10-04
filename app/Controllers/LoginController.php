<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use Random\RandomException;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    /**
     * @throws \ReflectionException
     * @throws RandomException
     */
    public function authenticate()
    {
        $request = \Config\Services::request();
        $mail = $request->getPost('mail');
        $password = $request->getPost('password');

        $userModel = new User();
        $usuario = $userModel->getUserByMail($mail);

        if (!$usuario) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Correo electrónico o contraseña incorrectos.'
            ]);
        }


        if ($usuario['password'] == null) {
            //TODO: Mandar al usuario a una pagina de reestablecer contraseña
            $token = bin2hex(random_bytes(50));
            $userModel->update($usuario['id'], ['reset_token' => $token, 'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))]);
            $resetLink = "/forgot_password/reset_password?token=" . $token;
            $response = [
                'success' => true,
                'redirect' => $resetLink
            ];
        }

        if (!$usuario['confirmed_email']) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Por favor, confirma tu correo electrónico antes de iniciar sesión.'
            ]);
        }


        if (!password_verify($password, $usuario['password'])) {
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

        $redirectUrl = $session->get('redirect_url') ? $session->get('redirect_url') : '/user/dashboard';
        $session->remove('redirect_url');

        $response = [
            'success' => true,
            'redirect' => $redirectUrl
        ];

        return $this->response->setJSON($response);

    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
