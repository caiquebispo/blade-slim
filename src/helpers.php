<?php

use BladeSlim\Blade;
use Psr\Http\Message\ResponseInterface;

if (!function_exists('view')) {
    /**
     * Retorna uma resposta HTTP com a view renderizada
     *
     * @param string $view Nome da view
     * @param array $data Dados para a view
     * @param int $status Código HTTP
     * @param array $headers Cabeçalhos HTTP
     * @return ResponseInterface
     */
    function view(
        string $view,
        array $data = [],
        int $status = 200,
        array $headers = []
    ): ResponseInterface {
        $blade = Blade::getInstance();

        if (is_null($blade)) {
            throw new \RuntimeException('Blade instance not initialized. Create Blade instance first.');
        }

        return $blade->view($view, $data, $status, $headers);
    }
}