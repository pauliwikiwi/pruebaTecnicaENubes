<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Room;
use CodeIgniter\HTTP\ResponseInterface;

class RoomController extends BaseController
{
    public function filter_room()
    {
        // Cargar el helper para manejar formularios
        helper(['form']);


    }

    public function getAllRooms()
    {
        // Instanciamos el modelo de habitaciones
        $room = new Room();

        // Obtenemos todas las habitaciones con sus respectivas categorías
        $rooms = $room->getHabitacionesConCategorias();

        // Pasamos los datos a la vista
        return view('rooms/view_rooms', ['rooms' => $rooms]);
    }
}
