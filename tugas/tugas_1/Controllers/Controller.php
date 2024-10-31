<?php

namespace Controllers;

abstract class Controller {
    protected function response($data) {
        return json_encode($data);
    }
}

?>
