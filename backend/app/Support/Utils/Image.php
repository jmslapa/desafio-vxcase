<?php

namespace Support\Utils;

use Illuminate\Support\Facades\Storage;

class Image
{
    /**
     * Armazena uma imagem em disco
     *
     * @param string $storagePath caminho relativo onde a imagem deve ser salva
     * @param string $disk drive de disco onde a imagem será salva
     * @param mixed $image arquivo de imagem que deve ser salvo
     * @return string retorna o caminho relativo do arquivo salvo
     */
    static public function store($storagePath, $disk, $image)
    {
        if($image->isValid()) {            
            return $image->store($storagePath, $disk);
        }
    }

    /**
     * Exclui um arquivo de imagem caso exista no disco
     *
     * @param string $imagePath caminho relativo do arquivo de imagem
     * @param string $disk nome do drive no qual a verificação será feita
     * @return void
     */
    static public function deleteIfExists($imagePath, $disk) {
        if(Storage::disk($disk)->exists($imagePath)) {
            Storage::disk($disk)->delete($imagePath);
        }
    }
}
