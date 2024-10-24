<?php

namespace App\Helper;

use Throwable;

class StorageHelper
{
    public function storage($data, $dir): string|array
    {
        // Tratando arquivo
        if ($data) {

            // Dividindo o nome do nome do arquivo (arquivo . extensão)
            $file = explode('.', $data['name']);
            // Pegando a extensão da imagem
            $extension = strtolower(end($file));
            // nome para ser salvo no banco de dados
            $nameFile = md5($file[0]) . '-' . date('YmdHmi') . '.' . $extension;
            // Verifica se é possível mover o arquivo para a pasta escolhida

            if (move_uploaded_file($data['tmp_name'], $dir . $nameFile)) {
                return $nameFile;
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Upload error'
                ];
            }
        }
    }

    public function deleteFile(string $data, string $dir): void
    {
        $urlFile = $dir . $data;
        unlink($urlFile);
    }
}