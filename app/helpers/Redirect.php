<?php

class Redirect {
    
    public static function href($location = '/') {

        header('Location: '. $location);
        exit();

    }
}