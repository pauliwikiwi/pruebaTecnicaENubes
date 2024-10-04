<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Reservation;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function generateReservationPDFById($id_reservation)
    {

        $reservationModel = new Reservation();
        $reservation =  $reservationModel->select('reservations.*, rooms.*, status_reservations.name as status, users.name as user_name, users.last_name as user_last_name')
            ->join('users', 'users.id = reservations.id_user')
            ->join('rooms', 'rooms.id = reservations.id_room')
            ->join('status_reservations', 'status_reservations.id = reservations.id_status')
            ->where('reservations.id', $id_reservation)->first();


        $data = [
            'reservation' => $reservation
        ];

        $html = view('reservation/view_reservation_pdf', $data);


        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();


        $dompdf->stream('documento.pdf', ['Attachment' => true]);
    }

}
