<?php
namespace App\Services\Parameters;

use App\Models\Parameters;
use App\Repository\Interfaces\ParametersRepositoryInterface;
use App\Services\Util\ConnectionService;
use Illuminate\Http\Request;
use PDO;

class ParametersService
{

    private $repository;
    public function __construct(ParametersRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list(Request $request)
    {
        return $this->repository->list($request);
    }

    public function store(array $dados)
    {
        /* if ($dados['uuid_Company']) {
            $dados['idCompany'] = $this->CompanysServices->buscaPorCampo('uuid', $dados['uuid_Company'])->idCompany;
        }
        unset($dados['uuid_Company']); */
        unset($dados['_token']);
        unset($dados['uuid']);
        return $this->repository->store($dados);
    }

    public function update(String $id, array $dados)
    {
        /* if ($dados['uuid_Company']) {
            $dados['idCompany'] = $this->CompanysServices->buscaPorCampo('uuid', $dados['uuid_Company'])->idCompany;
        }
        unset($dados['uuid_Company']); */
        unset($dados['_token']);
        return $this->repository->update($id, $dados);
    }

    public function destroy(array $dados)
    {
        return $this->repository->destroy($dados);
    }

    public function getCompany(String $uuid)
    {
        return;
    }

    public static function getParameter($parameter)
    {
        return Parameters::where('parameter', $parameter)->firstOrFail();
    }

    public static function getCompanyParameter($parameter, $company_id = null)
    {
        return Parameters::where(['parameter' => $parameter, 'company_id' => $company_id])->firstOrFail();
    }

    public static function getInitalConfig($parameter)
    {
        $sql = "select parameter,value from parameters where company_id is null and parameter = ? limit 1";
        if (!$p_sql = ConnectionService::getInstance()->prepare($sql)) {
            return '';
        };
        if (!$p_sql->execute([$parameter])) {
            return '';
        };
        $parameter_banco = $p_sql->fetchAll(PDO::FETCH_OBJ);
        return count($parameter_banco) > 0 ? $parameter_banco[0]->value : '';
    }

    public static function configEmail($idCompany = null)
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
            'mail.mailers.smtp.host' => Self::getCompanyParameter('MAIL_HOST', $idCompany)->value,
            'mail.mailers.smtp.port' => Self::getCompanyParameter('MAIL_PORT', $idCompany)->value,
            'mail.mailers.smtp.encryption' => Self::getCompanyParameter('MAIL_ENCRYPTION', $idCompany)->value,
            'mail.mailers.smtp.username' => Self::getCompanyParameter('MAIL_USERNAME', $idCompany)->value,
            'mail.mailers.smtp.password' => Self::getCompanyParameter('MAIL_PASSWORD', $idCompany)->value,
            'mail.from.address' => Self::getCompanyParameter('FROM_ENDERECO', $idCompany)->value,
            'mail.from.name' => Self::getCompanyParameter('NOME_DESCRICAO_EMAIL', $idCompany)->value,
        ]);
    }
}
