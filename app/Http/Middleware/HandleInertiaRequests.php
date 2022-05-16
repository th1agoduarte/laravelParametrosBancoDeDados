<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'menus' => [['descricao'=>'Estágio UPA','rota'=>''],
                        ['descricao'=>'Institucional','rota'=>''],
                        ['descricao'=>'Concurso e Processos Seletivos','rota'=>''],
                        ['descricao'=>'Projetos Sociais','rota'=>''],
                        ['descricao'=>'Contato','rota'=>''],],
            'contatos' => [['unidade' => 'Juazeiro do Norte',
                                            'contatos' => [['contato' => '(88) 3512-2450'], ['contato' => '0800 591 8710']],
                                            'enderecos' =>[['endereco'=>'Ed. Pátio Cariri Corporate -
                                            R. Catulo da Paixão Cearense, 175, Sala 1504, Triângulo, Juazeiro do
                                            Norte - CE, 63041 - 162']],
                            ],
                            ['unidade' => 'Recife',
                                            'contatos' => [['contato' => '(81) 3132-3399'], ['contato' => '(81) 98192-5492']],
                                            'enderecos' =>[['endereco'=>'Empresarial Iberbrás, Rua Ribeiro
                                            de Brito, 830, sala 904, Boa Viagem,
                                            Recife - PE']],
                            ],
                            ],
        ]);
    }
}
