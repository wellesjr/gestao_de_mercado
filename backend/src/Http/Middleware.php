<?php

class Middleware {
    function checkPostRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return[ 
                'sucess' => true,
                'message' => ''
            ];
        }

        return[ 
            'sucess' => false,
            'message' => 'Método não suportado.'
        ];
    }
}