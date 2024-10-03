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

        $token = bin2hex(random_bytes(16));


        // Guardar los datos del nuevo usuario en la base de datos

        if (getenv('CI_ENVIRONMENT') === 'development'){
            $userModel->save([
                'name' => $nombre,
                'last_name' => $apellidos,
                'email' => $correo,
                'password' => $hashedPassword,
                'email_token' => null,
                'confirmed_email' => true,
            ]);
        }else{
            $userModel->save([
                'name' => $nombre,
                'last_name' => $apellidos,
                'email' => $correo,
                'password' => $hashedPassword,
                'email_token' => $token,
                'confirmed_email' => false,
            ]);
        }

        // Enviar el correo de confirmación
        $this->enviarCorreoConfirmacion($correo, $token);


        return $this->response->setJSON([
            'success' => true,
            'message' => 'Registro exitoso. Por favor, revisa tu correo para confirmar tu cuenta.'
        ]);
    }
    private function enviarCorreoConfirmacion($email, $token)
    {
        $emailService = \Config\Services::email();

        $emailService->setTo($email);
        $emailService->setFrom('correo_pruebas_paula_blazquez@hotmail.com', 'Hotel Paula');
        $emailService->setSubject('Confirma tu correo electrónico');

        // Crear la URL de confirmación
        $confirmUrl = base_url() . 'confirm_email/' . $token;

        // Cargar la vista del correo
        $message = view('emails/confirmation_email', ['confirmUrl' => $confirmUrl]);

        $emailService->setMessage($message);

        // Enviar el correo
        if ($emailService->send()) {
            log_message('info', 'Correo de confirmación enviado a ' . $email);
        } else {
            log_message('error', 'Error al enviar el correo de confirmación.');
        }
    }
    // Método para confirmar el correo
    public function confirmarEmail($token)
    {
        $usuarioModel = new User();

        // Buscar al usuario por el token
        $usuario = $usuarioModel->where('token', $token)->first();

        if ($usuario) {
            // Confirmar el correo actualizando el campo email_confirmado
            $usuarioModel->update($usuario['id'], [
                'email_confirmado' => true,
                'token' => null // Eliminar el token
            ]);

            //TODO: Mandar a vista de correo confirmado correctamente
            echo 'Correo confirmado exitosamente.';
        } else {
            echo 'Token no válido o expirado.';
        }
    }
}
