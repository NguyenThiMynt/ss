<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.index');
    }

    public function createCalendar()
    {
        return view('calendar.create');
    }
}
