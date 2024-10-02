<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesRooms;
use App\Models\Reservation;
use App\Models\Room;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class RoomController extends BaseController
{
    public function filter_room()
    {
        $request = \Config\Services::request();

        // Obtener los datos enviados por el formulario
        $fecha_entrada = $request->getGet('fecha_entrada');
        $fecha_salida = $request->getGet('fecha_salida');
        $personas = $request->getGet('personas') ?? 2;
        $category = $request->getGet('category');
        $min_price = $request->getGet('min_price') ?? 0;
        $max_price = $request->getGet('max_price') ?? 500;

        if (empty($fecha_entrada) || empty($fecha_salida) || empty($personas)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Por favor, rellena todos los campos.'
            ]);
        }

        /*
            Buscar las reservas entre los días que marca el usuario
            Si existe una reserva, la habitación no sale
            De las habitaciones sin reserva, se filtra por mayor o igual al numero de personas seleccionadas
            Se incluyen los filtros del usuario que son opcionales
            Se ordena de precio menor a mayor
            Se mandan los datos al front
        */

        $reservation = new Reservation();

        $format_fecha_entrada = date("Y-m-d", strtotime($fecha_entrada));
        $format_fecha_salida = date("Y-m-d", strtotime($fecha_salida));

        $rooms_id = $reservation->where('entry_date >=', $format_fecha_entrada)
            ->where('departure_date <=', $format_fecha_salida)
            ->findColumn('id_room');

        $rooms = new Room();

        $roomQuery = $rooms->select('rooms.*, categories_rooms.name as category')
            ->join('categories_rooms', 'categories_rooms.id = rooms.id_category');



        if (isset($rooms_id)){
            $roomQuery->whereNotIn('rooms.id', $rooms_id);
        }

        if (isset($category)){
            $roomQuery->where('rooms.id_category', $category);
        }
        if ($min_price !== ''){
            $roomQuery->where('rooms.price >=', $min_price);
        }
        if ($max_price !== ''){
            $roomQuery ->where('rooms.price <=', $max_price);;
        }


        $roomModels = $roomQuery->orderBy('rooms.price', 'ASC')->findAll();

        $categories = new CategoriesRooms();
        $categories = $categories->findAll();


        return view('rooms/rooms',
            [
                'rooms' => $roomModels,
                'categories' => $categories,
                'fecha_entrada' => $fecha_entrada,
                'fecha_salida' => $fecha_salida,
                'personas' => $personas,
            ]);

    }

    public function getAllRooms()
    {
        // Instanciamos el modelo de habitaciones
        $room = new Room();
        $categories = new CategoriesRooms();

        // Obtenemos todas las habitaciones con sus respectivas categorías
        $rooms = $room->getHabitacionesConCategorias();
        $categories = $categories->findAll();

        $fecha_entrada = date('d-m-Y');
        $fecha_salida = date('d-m-Y', strtotime('+1 day'));
        $personas = 2;

        // Pasamos los datos a la vista
        return view('rooms/view_rooms', [
            'rooms' => $rooms,
            'categories' => $categories,
            'fecha_entrada' => $fecha_entrada,
            'fecha_salida' => $fecha_salida,
            'personas' => $personas
        ]);
    }


    public function bookingRoom($room_id)
    {
        $request = \Config\Services::request();

        $fecha_entrada = $request->getGet('checkin_date');
        $fecha_salida = $request->getGet('checkout_date');
        $personas = $request->getGet('guests');

        $isBooking = false;

        $format_fecha_entrada = date("Y-m-d", strtotime($fecha_entrada));
        $format_fecha_salida = date("Y-m-d", strtotime($fecha_salida));

        $reservationModel = new Reservation();
        $reservation = $reservationModel->where('entry_date >=', $format_fecha_entrada)
            ->where('departure_date <=', $format_fecha_salida)
            ->where('id_room', $room_id)
            ->first();

        if ($reservation){
            $isBooking = true;
        }

        $roomModel = new Room();
        $room = $roomModel->select('rooms.*, categories_rooms.name as category')
            ->join('categories_rooms', 'categories_rooms.id = rooms.id_category')
            ->where('rooms.id', $room_id)
            ->first();

        $entrada = new DateTime(date("Y-d-m", strtotime($fecha_entrada)));
        $salida = new DateTime(date("Y-d-m", strtotime($fecha_salida)));

        // Calcular la diferencia
        $diferencia = $entrada->diff($salida);
        $diasDiferencia = $diferencia->days;

        return view('rooms/booking_room', [
            'room' => $room,
            'fecha_entrada' => str_replace('/', '-', $fecha_entrada),
            'fecha_salida' => str_replace('/', '-', $fecha_salida),
            'personas' => $personas,
            'isBooking' => $isBooking,
            'diasDiferencia' => $diasDiferencia
        ]);
    }
}
