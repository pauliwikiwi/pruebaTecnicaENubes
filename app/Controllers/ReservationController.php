<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Reservation;
use App\Models\StatusReservations;
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
}
