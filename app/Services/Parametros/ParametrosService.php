<?php
namespace App\Services\Parametros;

use App\Models\parametros;
use App\Repository\Interfaces\ParametrosRepositoryInterface;
use App\Services\Empresas\EmpresasServices;
use App\Services\Util\ConexaoService;
use Illuminate\Http\Request;
use PDO;

class ParametrosService
{

    private $repository, $empresasServices;
    public function __construct(ParametrosRepositoryInterface $repository, EmpresasServices $empresasServices)
    {
        $this->repository = $repository;
        $this->empresasServices = $empresasServices;
    }

    public function lista(Request $request)
    {
        return $this->repository->lista($request);
    }

    public function store(array $dados)
    {
        if ($dados['uuid_empresa']) {
            $dados['idempresa'] = $this->empresasServices->buscaPorCampo('uuid', $dados['uuid_empresa'])->idempresa;
        }
        unset($dados['uuid_empresa']);
        unset($dados['_token']);
        unset($dados['uuid']);
        return $this->repository->store($dados);
    }

    public function update(String $id, array $dados)
    {
        if ($dados['uuid_empresa']) {
            $dados['idempresa'] = $this->empresasServices->buscaPorCampo('uuid', $dados['uuid_empresa'])->idempresa;
        }
        unset($dados['uuid_empresa']);
        unset($dados['_token']);
        return $this->repository->update($id, $dados);
    }

    public function destroy(array $dados)
    {
        return $this->repository->destroy($dados);
    }

    public function getEmpresa(String $uuid)
    {
        return;
    }

    public static function getParametro($parametro)
    {
        return parametros::where('parametro', $parametro)->firstOrFail();
    }

    public static function getEmpresaParametro($parametro, $idempresa = null)
    {
        return parametros::where(['parametro' => $parametro, 'idempresa' => $idempresa])->firstOrFail();
    }

    public static function getConfigIncial($parametro)
    {
        $sql = "select parametro,valor from parametros where idempresa is null and parametro = ? limit 1";
        if (!$p_sql = ConexaoService::getInstance()->prepare($sql)) {
            return '';
        };
        if (!$p_sql->execute([$parametro])) {
            return '';
        };
        $parametro_banco = $p_sql->fetchAll(PDO::FETCH_OBJ);
        return count($parametro_banco) > 0 ? $parametro_banco[0]->valor : '';
    }

    public static function configEmail($idempresa = null)
    {
        /* MAIL_HOST_CHAMADO - Host do e-mail para o chamado
         * MAIL_PORT_CHAMADO - Porta do SMTP do e-mail para o chamado
         * MAIL_USERNAME_CHAMADO - Usuário do Chamado SMTP do e-mail para o chamado
         * MAIL_PASSWORD_CHAMADO - Senha do Chamado SMTP do e-mail para o chamado
         * MAIL_ENCRYPTION_CHAMADO - Encripty do SMTP do e-mail para o chamado
         * FROM_ENDERECO_CHAMADO - E-mail de Envio do Chamado
         * NOME_DESCRICAO_EMAIL_CHAMADO - Descrição do nome do E-mail de Envio do Chamado
         */
        config([
            'mail.mailers.smtp.host' => Self::getEmpresaParametro('MAIL_HOST', $idempresa)->valor,
            'mail.mailers.smtp.port' => Self::getEmpresaParametro('MAIL_PORT', $idempresa)->valor,
            'mail.mailers.smtp.encryption' => Self::getEmpresaParametro('MAIL_ENCRYPTION', $idempresa)->valor,
            'mail.mailers.smtp.username' => Self::getEmpresaParametro('MAIL_USERNAME', $idempresa)->valor,
            'mail.mailers.smtp.password' => Self::getEmpresaParametro('MAIL_PASSWORD', $idempresa)->valor,
            'mail.from.address' => Self::getEmpresaParametro('FROM_ENDERECO', $idempresa)->valor,
            'mail.from.name' => Self::getEmpresaParametro('NOME_DESCRICAO_EMAIL', $idempresa)->valor,
        ]);
    }
}
