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

        $format_checkin = date("Y-m-d", strtotime($checkin));
        $format_checkout = date("Y-m-d", strtotime($checkout));

        try{
            $reservationModel->save([
                'id_user' => $userModel->where('email', $email)->first()['id'],
                'id_room' => $id_room,
                'id_status' => $status['id'],
                'entry_date' => $format_checkin,
                'departure_date' => $format_checkout,
            ]);
        }catch (\Exception $e){
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        return redirect()->to('/reservation/'. $reservationModel->getInsertID());
    }
}
