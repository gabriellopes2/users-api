<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class AutenticationService
{
    public static function login()
    {
       $url = 'http://localhost:8000/api/login';

       // Cabeçalhos personalizados que deseja enviar
        $headers = array(
            'Content-Type: application/json', // Exemplo de cabeçalho Content-Type
            'username: admin',
            'password: admin'
        );

       $ch = curl_init();

       // Configura as opções da requisição cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Define a URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Se true, retorna o resultado da transferência como string ao invés de imprimi-lo diretamente
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Se true, segue redirecionamentos
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Define os cabeçalhos da requisição
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); // Define o método HTTP

        // Executa a requisição cURL e obtém a resposta
        $response = curl_exec($ch);

        // Verifica se ocorreu algum erro durante a requisição
        if(curl_errno($ch)){
            echo 'Erro cURL: ' . curl_error($ch);
        }

        // Fecha a sessão cURL
        curl_close($ch);

        return json_decode($response);
    }

    public static function verificaAutenticacao($token)
    {
        if ($token != 'rBhtTZUZEC5fvADP3qzHkDgvx8D5efphajdIuiDdilhkMKFX1Lw25mzErp03TsMC')
        {
            return false;
        }

        return true;
    }
}