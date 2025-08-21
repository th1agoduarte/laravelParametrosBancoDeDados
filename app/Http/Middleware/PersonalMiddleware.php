<?php

namespace App\Http\Middleware;

use App\Services\Conf\ParametersService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class PersonalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routesControl = ['app.exec-shell.index',
                          'app.parameters.index',
                          'app.navigations.index',
                          'app.navigations.update',
                          'app.navigations.store',
                          'app.navigations.itemmenu.index',
                          'app.navigations.itemmenu.update',
                          'app.navigations.itemmenu.store',
                          'app.navigations.subitem.index',
                          'app.navigations.subitem.update',
                          'app.navigations.subitem.store',
                          'app.parameters.update',
                          'app.parameters.store',
                          'app.parameters.delete'];

        if (Auth::guard()->check()) {
            $user = Auth::guard()->user();
            $routeAccessed = $request->route()->getName();

            /*if (in_array($routeAccessed, $routesControl)) {
                if ($user->email != 'dev@meudominio.com.br') {
                    return redirect()->back()->with('permissionErro', "No permission to access this feature!");
                }
            }*/

            if($routeAccessed == 'app.exec-shell.index'){
                return redirect()->back()->with('permissionErro', "Shel Exec não Permitido!");
                if(Str::upper(ParametersService::getInitalConfig('ENABLE_SHELL_EXEC')) != 'S'){
                    return redirect()->back()->with('permissionErro', "Shel Exec não Habilitado!");
                }
                if(Str::upper(ParametersService::getInitalConfig('APP_DEBUG')) != 'S'){
                    return redirect()->back()->with('permissionErro', "Debug da Aplicação não Habilitado!");
                }
                if(Str::upper(ParametersService::getInitalConfig('APP_ENV')) != 'LOCAL'){
                    return redirect()->back()->with('permissionErro', "Shel exec não é permitido para ambiente de Produção!");
                }
                if($user->email !='dev@meudominio.com.br'){
                    return redirect()->back()->with('permissionErro', "Route not allowed: $routeAccessed");
                }
            }
            /* $idperfil = is_null($user->idperfil) ?
                        perfis::where('uuid', ParametersService::getParameter('PERFILPADRAO')->valor)
                        ->firstOrFail()->idperfil
                        : $user->idperfil; */


             /* if(ParametersService::getParameter("ROTAPADRAOPOSLOGIN")->valor == $rotaAcessada){
                return $next($request);
             } */

             /* if ($idperfil ==
                    perfis::where('uuid',ParametersService::getParameter('PERFILDEV')->valor)->firstOrFail()->idperfil
             ) {
                 return $next($request);
             } else {
                return redirect()->back()->with('errorPermissao', "Sem permissão para a Rota: $rotaAcessada");
             } */

            return $next($request);
        }else{
            return redirect('/')->with('permissionErro', "New Login Required!");
        }
    }
}
