<?php
namespace App\Services\Conf;

use App\Models\parameters;
use App\Repository\Interfaces\ParametersRepositoryInterface;
use App\Services\Utils\ConnectionService;
use Illuminate\Http\Request;
use PDO;

class ParametersService
{

    private $repository, $companysServices;
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
        /* if ($dados['uuid_company']) {
            $dados['company_id'] = $this->companysServices->buscaPorCampo('uuid', $dados['uuid_company'])->company_id;
        }
        unset($dados['uuid_company']); */
        unset($dados['_token']);
        unset($dados['uuid']);
        return $this->repository->store($dados);
    }

    public function update(String $id, array $dados)
    {
        if ($dados['uuid_company']) {
            $dados['company_id'] = $this->companysServices->buscaPorCampo('uuid', $dados['uuid_company'])->company_id;
        }
        unset($dados['uuid_company']);
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
        return parameters::where('parameter', $parameter)->firstOrFail();
    }

    public static function getCompanyParameter($parameter, $company_id = null)
    {
        return parameters::where(['parameter' => $parameter, 'company_id' => $company_id])->firstOrFail();
    }

    public static function getInitalConfig($parameter)
    {
        if (!self::tableExists()) {
            self::createTableParameters();
            self::insertParameters();
        }
        $sql = "select parameter,value from parameters where company_id is null and parameter = ? limit 1";
        switch(env('DB_CONNECTION')){
            case 'sqlsrv':
                $sql = "select top 1 parameter,value from parameters where company_id is null and parameter = ?";
                break;
            }

        if (!$p_sql = ConnectionService::getInstance()->prepare($sql)) {
            return '';
        };
        if (!$p_sql->execute([$parameter])) {
            return '';
        };
        $parameter_banco = $p_sql->fetchAll(PDO::FETCH_OBJ);
        return count($parameter_banco) > 0 ? $parameter_banco[0]->value : '';
    }

    public static function tableExists($table = 'parameters') {
        // Try a select statement against the table
        // Run it in try-catch in case PDO is in ERRMODE_EXCEPTION.
        $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = ? AND table_name = ?";
        if(env('DB_CONNECTION') == 'sqlsrv'){
            $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES where TABLE_NAME = ?";
        }

        try {
            if(!$p_sql = ConnectionService::getInstance()->prepare($sql)){
                    return FALSE;
            }
            if(env('DB_CONNECTION') == 'sqlsrv'){
                $p_sql->execute([$table]);
            }else{
                $p_sql->execute([env('DB_DATABASE'), $table]);
            }
            $row = $p_sql->fetchAll( PDO::FETCH_ASSOC );
            if($p_sql->rowCount() > 0){
                return TRUE;
            }

        } catch (Exception $e) {
            // We got an exception == table not found
            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return  FALSE;
    }

    public static function createTableParameters()
    {
        /*
            KEY parameters_company_id_foreign (company_id

            CONSTRAINT parameters_company_id_foreign FOREIGN KEY (company_id) REFERENCES companys (company_id) ON DELETE CASCADE ON UPDATE CASCADE
         */
        $tipoIcrementDataBase = env('DB_CONNECTION') == 'sqlsrv' ? 'IDENTITY(1,1)' : 'auto_increment unique';
        $sql = "CREATE TABLE parameters (
            id int not null primary key {$tipoIcrementDataBase},
            uuid  char(36) NOT NULL,
            company_id int NULL,
            parameter VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL,
            value VARCHAR(255) NULL,
            type_secret VARCHAR(1) DEFAULT 'N',
            comment VARCHAR(255) NULL,
            created_at datetime NOT NULL,
            updated_at datetime NOT NULL,
            deleted_at datetime DEFAULT NULL
            )";
        if (!$p_sql = ConnectionService::getInstance()->prepare($sql)) {
            return '';
        };
        if (!$p_sql->execute()) {
            return '';
        };
        return true;
    }

    //insert parameters
    public static function insertParameters()
    {
        $sql = "INSERT INTO parameters (uuid,company_id, parameter,description, value,type_secret,comment,  created_at, updated_at)
        VALUES
        ('ec66fbf4-2b53-11ee-b9aa-0242ac150002',NULL,'APP_VERSION','Version APP','1.0.0','N','APP Settings','2023-01-12 09:16:04','2023-01-12 23:28:49'),
        ('2109001e-a389-44aa-b1ce-4ec79e281a5e',NULL,'APP_NAME','Name APP','TD','N','APP Settings','2023-01-12 09:16:04','2023-01-12 23:28:49'),
('3c6ccc37-aebe-4013-9b6f-1dfd8b2ed257',NULL,'APP_ENV','APP location (Production/Local)','local','N','APP Settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('6a95a55c-88b7-4d1b-9487-bc93e9aa1968',NULL,'APP_DEBUG','Enable debug','Y','N','APP Settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('61aa82cf-3e60-4edc-8a3e-fa57f57bbc46',NULL,'APP_URL','URI App','https://meudominio.com.br/','N','APP Settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('aaab009a-6e47-40e0-8452-5b1250df5f5f',NULL,'locale','APP Location','en-US','N','APP Settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('ebc2bd7a-ef43-4ef0-b346-c80b42961ba2',NULL,'timezone','Timezone APP','America/Chicago','N','APP Settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('ae8d06c8-faf3-4a64-8a12-32570f3331ed',NULL,'FILESYSTEM_DRIVER','Default Storage Driver','local','N','Filesystem Settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('606f647a-5aef-4c0a-b246-7a1c721f0003',NULL,'MAIL_MAILER','Email server type','smtp','N','Mail settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('4ba2663f-f3ba-44e7-8113-aad861e1d4e8',NULL,'MAIL_HOST','Email host','','N','Mail settings','2023-01-12 09:16:04','2023-10-03 14:39:45'),
('ca85349a-16c3-4813-b5a8-c6f4349afde2',NULL,'MAIL_PORT','Email SMTP port','587','N','Mail settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('b75dc627-c78b-4af1-b5f8-423a148cc35e',NULL,'MAIL_USERNAME','Email SMTP User','','N','Mail settings','2023-01-12 09:16:04','2023-10-03 14:40:09'),
('bc945b98-a669-4bb7-bf82-1792bba86bb6',NULL,'MAIL_PASSWORD','Email SMTP Smtp','','Y','Mail settings','2023-01-12 09:16:04','2023-10-03 14:40:32'),
('10c4ffd2-c511-4916-bb7c-3aefa28f119a',NULL,'MAIL_ENCRYPTION','Email SMTP Encryption','tls','N','Mail settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('0dffd564-43a4-4ba0-a1a2-99e1c4ac6972',NULL,'MAIL_FROM_ADDRESS','Mail from Address','dev@meudominio.com.br','N','Mail settings','2023-01-12 09:16:04','2023-10-03 14:41:10'),
('e3332a8b-39b7-417d-800b-58b5fe410f03',NULL,'MAIL_FROM_NAME','Email Sender Description Name','Contact TD','N','Mail settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('15992125-6084-44b0-803c-b58d94593817',NULL,'AWS_ACCESS_KEY_ID','AWS Identification Key','','N','AWS settings','2023-01-12 09:16:04','2023-10-03 14:15:45'),
('6b04237f-cb44-464d-aa29-2e301d531916',NULL,'AWS_SECRET_ACCESS_KEY','AWS Secret Key','','N','AWS settings','2023-01-12 09:16:04','2023-10-03 14:16:05'),
('153fa443-d69c-4ca1-a489-9de58da6b845',NULL,'AWS_REGION','AWS Bucket Region','us-east-1','N','AWS settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('53cfb2f0-3d6e-4e8f-a414-b3baccdcf1b1',NULL,'AWS_BUCKET','Bucket AWS','','N','AWS settings','2023-01-12 09:16:04','2023-10-03 14:21:38'),
('e072f148-d27b-43c8-b850-e4532590f723',NULL,'AWS_URL','URI AWS','','N','AWS settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('b5ee9b3f-8b88-4fef-95b8-2ca523d30a2c',NULL,'AWS_ENDPOINT','End Point AWS','','N','AWS settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('525d3313-faa8-4200-9ca1-16444d9f6928',NULL,'AWS_USE_PATH_STYLE_ENDPOINT','Path Style End Point AWS','','N','AWS settings','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('d5b0b24a-e05f-48e9-9942-f24355636d30',NULL,'PERFIL_DEV','Default Dev Profile UUID','','N','APP Settings Access Permissions','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('26a10792-f200-42d0-8510-5a967e290abc',NULL,'PERFIL_ADMINISTRADOR','Admin Profile UUID','','N','APP Settings Access Permissions','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('da0b11a1-85d1-40c5-9f4d-a12836d46eec',NULL,'PERFIL_USUARIO','Default User Profile UUID','','N','APP Settings Access Permissions','2023-01-12 09:16:04','2023-01-12 09:16:04'),
('157d82a9-97d8-11ec-ae12-641c679fa4db',NULL,'DEBUGBAR_ENABLED','Enable/Disable the Debug Bar','N','N','APP Settings','2023-02-27 09:00:00','2023-02-27 09:00:00');
        ";


        if (!$p_sql = ConnectionService::getInstance()->prepare($sql) ) {
            return false;
        }
        if (!$p_sql->execute()) {
            return false;
        }
        return true;
    }

    public static function configEmail($company_id = null)
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
            'mail.mailers.smtp.host' => Self::getCompanyParameter('MAIL_HOST', $company_id)->value,
            'mail.mailers.smtp.port' => Self::getCompanyParameter('MAIL_PORT', $company_id)->value,
            'mail.mailers.smtp.encryption' => Self::getCompanyParameter('MAIL_ENCRYPTION', $company_id)->value,
            'mail.mailers.smtp.username' => Self::getCompanyParameter('MAIL_USERNAME', $company_id)->value,
            'mail.mailers.smtp.password' => Self::getCompanyParameter('MAIL_PASSWORD', $company_id)->value,
            'mail.from.address' => Self::getCompanyParameter('FROM_ENDERECO', $company_id)->value,
            'mail.from.name' => Self::getCompanyParameter('NOME_DESCRICAO_EMAIL', $company_id)->value,
        ]);
    }
}
