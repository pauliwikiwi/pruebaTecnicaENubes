<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class ForgotPasswordController extends BaseController
{
    public function index()
    {
        return view('auth/forgot_password');
    }

    public function sendEmail()
    {
        $userModel = new User();
        $request = \Config\Services::request();
        $email = $request->getPost('mail');

        // Verificar si el correo existe
        $user = $userModel->where('email', $email)->first();
        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'El correo no está registrado.'
            ]);
        }

        // Generar un token único para el enlace
        $token = bin2hex(random_bytes(50));  // Genera un token único
        $userModel->update($user['id'], ['reset_token' => $token, 'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))]);

        // Crear el enlace de restablecimiento de contraseña
        $resetLink = base_url() . "/forgot_password/reset_password?token=" . $token;

        // Enviar el correo electrónico
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Restablecer contraseña');
        $emailService->setMessage('Haz clic en el siguiente enlace para restablecer tu contraseña: <a href="' . $resetLink . '">Restablecer contraseña</a>');

        if ($emailService->send()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Se ha enviado un correo con las instrucciones para restablecer la contraseña.'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Hubo un error al enviar el correo.'
            ]);
        }
    }

    public function reset_password()
    {
        $request = \Config\Services::request();
        $token = $request->getGet('token');

        $userModel = new User();
        $user = $userModel->where('reset_token', $token)->where('reset_token_expires >=', date('Y-m-d H:i:s'))->first();

        if (!$user) {
            return "Enlace inválido o ha expirado.";
        }

        return view('reset_password', ['token' => $token]);
    }

    public function save_new_password()
    {
        $request = \Config\Services::request();
        $token = $request->getPost('token');
        $newPassword = $request->getPost('password');

        $userModel = new User();
        $user = $userModel->where('reset_token', $token)->where('reset_token_expires >=', date('Y-m-d H:i:s'))->first();

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Enlace inválido o ha expirado.'
            ]);
        }

        // Hashear la nueva contraseña
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Actualizar la contraseña y eliminar el token de restablecimiento
        $userModel->update($user['id'], [
            'password' => $hashedPassword,
            'reset_token' => null,
            'reset_token_expires' => null
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Tu contraseña ha sido actualizada correctamente.'
        ]);
    }
}
