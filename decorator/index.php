<?php

interface CarService {
    public function getCost();
    public function getDescription();
}

class BasicInspection implements CarService {
    public function getCost()
    {
        return 25;
    }

    public function getDescription()
    {
        return 'Basic inspection';
    }
}

class OilChange implements CarService {

    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return 29 + $this->carService->getCost();
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ' and oil change';
    }
}

class TireRotation implements CarService {

    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return 15 + $this->carService->getCost();
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ' and a tire rotation';
    }
}

//echo (new TireRotation(new OilChange(new BasicInspection)))->getCost();
$service = new OilChange(new TireRotation(new BasicInspection));

echo $service->getDescription();