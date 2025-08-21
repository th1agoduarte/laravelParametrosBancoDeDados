<?php
namespace App\Services\Utils;

use App\Services\Conf\ParametersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageFiles
{

    public static function storageAttachment(Request $request, $campo, $path = '')
    {
        try {
            if ($request->$campo && $request->hasFile($campo) && $request->$campo->isValid()) {
                $arquivo = $request->$campo;
                $pathArquivo = trim("$path" . $request->user()->uuid . "[" . date('YmdHis') . "]-" . $campo . "-" . $arquivo->getClientOriginalName());
                $pathRetronoArquivo = trim("$path" . $request->user()->uuid . "[" . date('YmdHis') . "]-" . $campo . "-" . $arquivo->getClientOriginalName());
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
    }}

    public static function temporaryUrl($arquivo)
    {
        try {
            if (ParametersService::getInitalConfig('FILESYSTEM_DRIVER') != 's3') {
                return Storage::url($arquivo);
            } else {
                return self::disk()->temporaryUrl($arquivo, now()->addHour(10), ['ResponseContentDisposition' => 'attachment']);
            }

        } catch (\Exception$e) {
            return $e->getCode();
        }
    }

    public static function url($arquivo)
    {
        try {
            return Storage::url($arquivo);
        } catch (\Exception$e) {
            return $e->getCode();
        }
    }

    public static function disk()
    {
        return $disk = Storage::disk();
    }
}
