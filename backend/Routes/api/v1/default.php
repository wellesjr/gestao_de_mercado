<?php

use \App\Http\Response;

$obRouter->get('/api/v1', [
    function($request) {
        return new Response(200, 'API V1');
    }
]);