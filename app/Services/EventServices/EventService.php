<?php

namespace App\Services\EventServices;

use App\Models\Event;
use Illuminate\Support\Facades\Cache;
use App\Jobs\Event as EventJob;
use App\Services\EventServices\EventServiceTrait;

class EventService
{
    use EventServiceTrait;

    private $ModelEvent;

    public function __construct()
    {
        $this->ModelEvent = new Event();
    }


    public function save(string $title, string $place, string $date): string
    {
        // устанавливаем свойства
        $this->setPropToModel($title, $place, $date);

        // Отправляем в очередь
        EventJob::dispatch();

        $keyCache =  $title . '-' .  $place . '-' . $date;

        // Добавляем в кеш 5минут
        Cache::add($keyCache, $this->ModelEvent, 300);

        return 'Событие успешно добавлено id Event = ' . $keyCache;
    }

    public function show($idEvent)
    {
        if (Cache::has($idEvent)) {
            $this->ModelEvent =  Cache::get($idEvent);

            return 'название мероприятия : ' . $this->ModelEvent->title
                . ' место проведения мероприятия: ' . $this->ModelEvent->place
                . ' период: ' . $this->ModelEvent->period
                . ' тип периода: ' . $this->ModelEvent->periodType;
        } else {
            return ' Такого события нет, зарегестрируйте его на странице /event/{title}/{place}/{21-09-2023}';
        }
    }
}
