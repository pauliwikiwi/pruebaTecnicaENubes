<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReservationController extends BaseController
{
    public function index()
    {
        return view('user/dashboard');
    }
}
