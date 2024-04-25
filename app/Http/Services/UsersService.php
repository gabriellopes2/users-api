<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class UsersService
{
    public static function register(Request $request, $token)
    {
        $url = 'http://eventsfull.com.br/api/users';

        // Cabeçalhos personalizados que deseja enviar
        $headers = array(
            'Content-Type: application/json', // Exemplo de cabeçalho Content-Type
            'Authorization: Bearer ' . $token
        );

        $data = array(
            "name" => $request->name,
            "username" => $request->username,
            "password" => $request->password
        );

        $jsonData = json_encode($data);
        $ch = curl_init();

        // Configura as opções da requisição cURL
        curl_setopt($ch, CURLOPT_URL, $url); // Define a URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Se true, retorna o resultado da transferência como string ao invés de imprimi-lo diretamente
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Se true, segue redirecionamentos
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true); // Define o método HTTP como POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Define os dados a serem enviados no corpo da requisição

        // Executa a requisição cURL e obtém a resposta
        $response = curl_exec($ch);

        // Verifica se ocorreu algum erro durante a requisição
        if(curl_errno($ch)){
            return curl_error($ch);
        }

        // Fecha a sessão cURL
        curl_close($ch);

        return $response;
    }
}