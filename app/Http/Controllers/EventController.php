<?php

namespace App\Http\Controllers;

use App\Services\EventServices\EventService;

class EventController extends Controller
{

    public function save(string $title, string $place, string $date):string
    {
        return (new EventService())->save($title, $place, $date);
    }

    public function show(string $id):string
    {
        return (new EventService())->show($id);
    }
}
