<?php

namespace App;

class ExampleController {
    protected $service;

    public function __construct(ExampleService $service) {
        $this->service = $service;
    }

    public function handle() {
        echo $this->service->execute();
    }
}
?>
