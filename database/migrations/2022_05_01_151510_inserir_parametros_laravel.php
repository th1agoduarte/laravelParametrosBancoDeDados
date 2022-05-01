<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            DB::statement("INSERT INTO `parametros` VALUES
                            (1,'2109001e-a389-44aa-b1ce-4ec79e281a5e',NULL,'APP_NAME','Nome do Aplicativo','UPA','Configurações APP - Nome do Aplicativo','2022-01-12 03:16:04','2022-01-15 17:28:49'),
                            (2,'3c6ccc37-aebe-4013-9b6f-1dfd8b2ed257',NULL,'APP_ENV','Local do APP','local','Configurações APP','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (3,'6a95a55c-88b7-4d1b-9487-bc93e9aa1968',NULL,'APP_DEBUG','Habilitar debug','S','Configurações APP','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (4,'61aa82cf-3e60-4edc-8a3e-fa57f57bbc46',NULL,'APP_URL','URL App','https://www.upa.local','Configurações APP','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (5,'aaab009a-6e47-40e0-8452-5b1250df5f5f',NULL,'locale','Localização APP','pt-BR','Configurações APP','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (6,'ebc2bd7a-ef43-4ef0-b346-c80b42961ba2',NULL,'timezone','Timezone APP','America/Sao_Paulo','Configurações APP','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (7,'ae8d06c8-faf3-4a64-8a12-32570f3331ed',NULL,'FILESYSTEM_DRIVER','Driver padrão de armazenamento','local','Configurações Filesystem','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (8,'606f647a-5aef-4c0a-b246-7a1c721f0003',NULL,'MAIL_MAILER','Tipo de servidor de Email','smtp','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (9,'4ba2663f-f3ba-44e7-8113-aad861e1d4e8',NULL,'MAIL_HOST','Host do e-mail','','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (10,'ca85349a-16c3-4813-b5a8-c6f4349afde2',NULL,'MAIL_PORT','Porta do SMTP do e-mail','587','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (11,'b75dc627-c78b-4af1-b5f8-423a148cc35e',NULL,'MAIL_USERNAME','Usuário do Chamado SMTP do e-mail','','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (12,'bc945b98-a669-4bb7-bf82-1792bba86bb6',NULL,'MAIL_PASSWORD','Senha do Chamado SMTP do e-mail','','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (13,'10c4ffd2-c511-4916-bb7c-3aefa28f119a',NULL,'MAIL_ENCRYPTION','Encripty do SMTP do e-mail','tls','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (14,'0dffd564-43a4-4ba0-a1a2-99e1c4ac6972',NULL,'MAIL_FROM_ADDRESS','E-mail de Envio','','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (15,'e3332a8b-39b7-417d-800b-58b5fe410f03',NULL,'MAIL_FROM_NAME','Descrição do nome do E-mail de Envio','Universidade Patativa do Assaré','Configurações mail','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (16,'15992125-6084-44b0-803c-b58d94593817',NULL,'AWS_ACCESS_KEY_ID','Chave de Indentificação AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (17,'6b04237f-cb44-464d-aa29-2e301d531916',NULL,'AWS_SECRET_ACCESS_KEY','Chave de Secreta AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (18,'153fa443-d69c-4ca1-a489-9de58da6b845',NULL,'AWS_DEFAULT_REGION','Região do Bucket AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (19,'53cfb2f0-3d6e-4e8f-a414-b3baccdcf1b1',NULL,'AWS_BUCKET','Bucket AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (20,'e072f148-d27b-43c8-b850-e4532590f723',NULL,'AWS_URL','URL AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (21,'b5ee9b3f-8b88-4fef-95b8-2ca523d30a2c',NULL,'AWS_ENDPOINT','End Point AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (22,'525d3313-faa8-4200-9ca1-16444d9f6928',NULL,'AWS_USE_PATH_STYLE_ENDPOINT','Path Style End Point AWS','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (24,'d5b0b24a-e05f-48e9-9942-f24355636d30',NULL,'PERFIL_DEV','UUID do Perfil Padrao do Dev','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (25,'26a10792-f200-42d0-8510-5a967e290abc',NULL,'PERFIL_ADMINISTRADOR','UUID do Perfil Administrador do Motorista','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (26,'da0b11a1-85d1-40c5-9f4d-a12836d46eec',NULL,'PERFIL_USUARIO','UUID do Perfil Padrao do Usuario','','Configurações AWS','2022-01-12 03:16:04','2022-01-12 03:16:04'),
                            (50,'157d82a9-97d8-11ec-ae12-641c679fa4db',NULL,'DEBUGBAR_ENABLED','Habilita Desbalita o Debug Bar','S','Configurações APP','2022-02-27 03:00:00','2022-02-27 03:00:00');");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
