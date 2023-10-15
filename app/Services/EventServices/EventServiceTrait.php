<?php
namespace App\Services\EventServices;

trait EventServiceTrait
{

    private function setPeriodType(int $day): int
    {
        $period = 0;

        if ($day >= 365) {
            $this->ModelEvent->periodType = 'Год';
            $period = $day / 365;
        } elseif ($day >= 30) {
            $this->ModelEvent->periodType = 'Месяц';
            $period = $day / 30;
        } else {
            $this->ModelEvent->periodType = 'День';
            $period = $day;
        }

        return round($period);
    }

    private function setPeriod($date, $period)
    {
        if ($date > 0) {
            $this->ModelEvent->period = $period;
        } else {
            $this->ModelEvent->period = -1 * $period;
        }
    }

    private function setDate($date)
    {
        $date = strtotime($date) - time();
        $day = abs($date / 86400);

        $period = $this->setPeriodType($day);

        $this->setPeriod($date, $period);
    }

    private function setPropToModel(string $title, string $place, string $date)
    {
        $this->setDate($date);
        $this->ModelEvent->title = $title;
        $this->ModelEvent->place = $place;
    }
}
