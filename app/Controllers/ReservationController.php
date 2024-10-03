<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Reservation;
use App\Models\StatusReservations;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class ReservationController extends BaseController
{
    public function index()
    {
        $reservationModel = new Reservation();

        $session = session();
        if ($session->get('logged_in') == 1) {
            $email = $session->get('usuario_email');
        }

        $reservations = $reservationModel->select('reservations.*, reservations.id as id_reservation, rooms.*, status_reservations.name as status')
            ->join('users', 'users.id = reservations.id_user')
            ->join('rooms', 'rooms.id = reservations.id_room')
            ->join('status_reservations', 'status_reservations.id = reservations.id_status')
            ->where('users.email', $email)->findAll();

        return view('user/dashboard', ['reservations' => $reservations]);
    }

    public function getReservationById($id_reservation)
    {
        $reservationModel = new Reservation();
        $reservation =  $reservationModel->select('reservations.*, rooms.*, status_reservations.name as status, users.name as user_name, users.last_name as user_last_name')
            ->join('users', 'users.id = reservations.id_user')
            ->join('rooms', 'rooms.id = reservations.id_room')
            ->join('status_reservations', 'status_reservations.id = reservations.id_status')
            ->where('reservations.id', $id_reservation)->first();

        return view('user/view_reservation', ['reservation' => $reservation]);
    }

    public function cancelReservationById($id_reservation)
    {

        $statusModel = new StatusReservations();

        $status = $statusModel->where('name', 'Cancelada')->first();

        $reservationModel = new Reservation();

        $data = ['id_status' => $status['id']];
        $reservationModel->update($id_reservation, $data);

        // Responde con éxito
        return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
            ->setJSON(['success' => true, 'message' => 'Estado actualizado']);


    }

    public function reservationRoom()
    {

        $request = \Config\Services::request();

        date_default_timezone_set('Europe/Madrid');

        $checkin = $request->getPost('checkin');
        $checkout = $request->getPost('checkout');
        $id_room = $request->getPost('id_room');

        $name_user = $request->getPost('name');
        $last_name_user = $request->getPost('last_name');
        $email = $request->getPost('email');

        $phone = $request->getPost('phone');
        $identification = $request->getPost('identification');

        $holder = $request->getPost('titular');
        $card_number = $request->getPost('num_tarjeta');
        $expiration_date = $request->getPost('caducidad');
        $cvv = $request->getPost('cvv');

        /*
         * TODO: validaciones en los campos
         */

        //Buscamos el usuario y sino, se crea
        $userModel = new User();

        $existingUser = $userModel->where('email', $email)->first();

        if (!$existingUser) {
            try{
                $userModel->save([
                    'name' => $name_user,
                    'last_name' => $last_name_user,
                    'email' => $email,
                    'password' => null,
                    'contact_identifier' => $identification,
                    'contact_telephone' => $phone,
                    'email_token' => null,
                    'confirmed_email' => false,
                ]);
            }catch (\Exception $e){
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
            }
        }else{
            $updateData = [
                'contact_identifier' => $identification,
                'contact_telephone' => $phone
            ];

            try{
                $userModel->update($existingUser['id'], $updateData);
            }catch (\Exception $e){
                return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
            }


        }

        //TODO:envio de datos de pago a API
        // Si el pago es correcto, se crea la solicitud de reserva

        $reservationModel = new Reservation();

        $statusModel = new StatusReservations();
        $status = $statusModel->where('name', 'Pendiente de confirmación')->first();

        $format_checkin = date('Y-m-d', $checkin/1000);
        $format_checkout = date('Y-m-d', $checkout/1000);

        try{
            $reservation_token = bin2hex(random_bytes(16));
            $reservationModel->save([
                'id_user' => $userModel->where('email', $email)->first()['id'],
                'id_room' => $id_room,
                'id_status' => $status['id'],
                'entry_date' => $format_checkin,
                'departure_date' => $format_checkout,
                'reservation_token' => $reservation_token,
                'confirmed' => false
            ]);

            //TODO: Mandar correo de pendiente confirmar la reserva
            $this->sendMailReservationConfirm(
                $name_user,
                $last_name_user,
                $email,
                $phone,
                $identification,
                $format_checkin,
                $format_checkout,
                $reservation_token);


        }catch (\Exception $e){
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        $response = [
            'success' => true,
            'redirect' => '/reservation/' . $reservationModel->getInsertID()  // Redirigir a la página de destino
        ];

        return $this->response->setJSON($response);
    }

    public function sendMailReservationConfirm($name_user, $last_name_user, $email, $phone, $identification, $checkin, $checkout, $reservation_token)
    {

        $urlCambiarEstado = base_url("confirm_reservation/$reservation_token");

        // Crear el contenido del correo
        $asunto = "Confirmación de Reserva";
        $mensaje = "
            <html lang='es'>
            <head>
                <title>Confirmación de Reserva</title>
            </head>
            <body>
                <h2>Hola $name_user $last_name_user,</h2>
                <p>Gracias por tu reserva en nuestra habitación. A continuación, los detalles de tu reserva:</p>
                <ul>
                    <li><strong>Check-in:</strong> $checkin</li>
                    <li><strong>Check-out:</strong> $checkout</li>
                    <li><strong>Nombre:</strong> $name_user $last_name_user</li>
                    <li><strong>Email:</strong> $email</li>
                    <li><strong>Teléfono:</strong> $phone</li>
                    <li><strong>Identificación:</strong> $identification</li>
                </ul>
                <p>Para cambiar el estado de tu reserva, haz clic en el siguiente enlace:</p>
                <p><a href='$urlCambiarEstado'>Cambiar estado de la reserva</a></p>
                <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
                <p>¡Gracias por elegirnos!</p>
            </body>
            </html>
        ";

        // Configurar el servicio de email
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setFrom('noreply@hotelpaula.com', 'Hotel Paula');
        $emailService->setSubject($asunto);
        $emailService->setMessage($mensaje);
        $emailService->setHeader('Content-Type', 'text/html');

        // Enviar el correo
        if ($emailService->send()) {
            echo "Correo de confirmación enviado a $email.";
        } else {
            echo "Error al enviar el correo: " . $emailService->printDebugger(['headers']);
        }
    }

    public function confirmReservation($reservation_token)
    {
        $reservationModel = new Reservation();
        $reservation = $reservationModel->where('reservation_token', $reservation_token)->first();

        $statusModel = new StatusReservations();
        $status = $statusModel->where('name', 'Confirmada')->first();

        $data_to_update = [
            'confirmed' => true,
            'reservation_token' => null,
            'id_status' => $status['id']
        ];

        try {
            $reservationModel->update($reservation['id'], $data_to_update);
            echo 'Reserva confirmada exitosamente.';
            //TODO: mandar a una vista de reserva confirmada correctamente
        }catch (\Exception $exception){
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }
    }

    public function checkAvailability($id_room)
    {
        $request = \Config\Services::request();
        date_default_timezone_set('Europe/Madrid');


        $checkin = $request->getGet('checkin');
        $checkout = $request->getGet('checkout');
        $format_fecha_entrada = date('Y-m-d', $checkin/1000);
        $format_fecha_salida = date('Y-m-d', $checkout/1000);

        $isBooking = false;

        $reservationModel = new Reservation();
        $reservation = $reservationModel->where('entry_date >=', $format_fecha_entrada)
            ->where('departure_date <=', $format_fecha_salida)
            ->where('id_room', $id_room)
            ->first();

        if ($reservation){
            $isBooking = true;
        }

        $response = [
            'success' => true,
            'isBooking' => $isBooking,
        ];

        return $this->response->setJSON($response);
    }
}
