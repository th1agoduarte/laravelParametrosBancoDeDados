<?php
namespace App\Services\Util;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArmazenamentoArquivos
{

    public static function armazenarAnexo(Request $request, $campo, $path = '')
    {
        try {
            if ($request->$campo && $request->hasFile($campo) && $request->$campo->isValid()) {
                $arquivo = $request->$campo;
                $pathArquivo = trim("public/$path" . $request->user()->uuid . "/[" . date('YmdHis') . "]-" . $campo . "-" . $arquivo->getClientOriginalName());
                $pathRetronoArquivo = trim("$path" . $request->user()->uuid . "/[" . date('YmdHis') . "]-" . $campo . "-" . $arquivo->getClientOriginalName());
                if (self::disk()->put($pathArquivo, file_get_contents($arquivo))) {
                    return $pathRetronoArquivo;
                } else {
                    return false;
                }
            } else {
                return "erro";
            }
        } catch (\Exception$e) {
            return $e->getMessage();
        }

    }

    public static function dowload($arquivo)
    {try {
        return self::disk()->download($arquivo);
    } catch (\Exception$e) {
        return $e->getCode();
    }

    }

    public static function disk()
    {
        /* Storage::build([
        'driver' => 's3',
        'key' => ParametrosService::getParametro('AWS_ACCESS_KEY_ID_CHAMADOS')->valor,
        'secret' => ParametrosService::getParametro('AWS_SECRET_ACCESS_KEY_CHAMADOS')->valor,
        'region' => ParametrosService::getParametro('AWS_DEFAULT_REGION_CHAMADOS')->valor,
        'bucket' => ParametrosService::getParametro('AWS_BUCKET_CHAMADOS')->valor,
        'use_path_style_endpoint' => false,
        ]); */
        return $disk = Storage::disk();

    }
}
