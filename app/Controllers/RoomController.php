<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesRooms;
use App\Models\Reservation;
use App\Models\Room;
use CodeIgniter\HTTP\ResponseInterface;

class RoomController extends BaseController
{
    public function filter_room()
    {
        // Cargar el servicio request para obtener los datos
        $request = \Config\Services::request();

        // Obtener los datos enviados por el formulario
        $fecha_entrada = $request->getPost('fecha_entrada');
        $fecha_salida = $request->getPost('fecha_salida');
        $personas = $request->getPost('personas');

        // Validar los datos recibidos (puedes ampliar estas validaciones)
        if (empty($fecha_entrada) || empty($fecha_salida) || empty($personas)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Por favor, rellena todos los campos.'
            ]);
        }

        //Buscar las reservas entre los días que marca el usuario
        //Si existe una reserva, la habitación no sale
        //De las habitaciones sin reserva, se filtra por mayor o igual al numero de personas seleccionadas
        //Se returnea a la vista de habitaciones pero con habitaciones reducidas

        $reservation = new Reservation();

        $format_fecha_entrada = date("Y-m-d", strtotime($fecha_entrada));
        $format_fecha_salida = date("Y-m-d", strtotime($fecha_salida));

        $rooms_id = $reservation->where('entry_date >=', $format_fecha_entrada)
            ->where('departure_date <=', $format_fecha_salida)
            ->findColumn('id_room');

        $rooms = new Room();

        if (isset($rooms_id)){
            $roomModels = $rooms->select('rooms.*, categories_rooms.name as category')
                ->whereNotIn('rooms.id', $rooms_id)
                ->join('categories_rooms', 'categories_rooms.id = rooms.id_category')
                ->orderBy('rooms.price', 'ASC')->findAll();
        }else{
            $roomModels = $rooms->getHabitacionesConCategorias();
        }


        // Retornar respuesta de éxito
        $response = [
            'success' => true,
            'redirect' => '/rooms'  // Redirigir a la página de destino
        ];

        return $this->response->setJSON($response);

    }

    public function getAllRooms()
    {
        // Instanciamos el modelo de habitaciones
        $room = new Room();
        $categories = new CategoriesRooms();

        // Obtenemos todas las habitaciones con sus respectivas categorías
        $rooms = $room->getHabitacionesConCategorias();
        $categories = $categories->findAll();

        // Pasamos los datos a la vista
        return view('rooms/view_rooms', ['rooms' => $rooms, 'categories' => $categories]);
    }
}
