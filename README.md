# Laravel + Vue.js Application

Sistema web baseado em Laravel com frontend Vue.js 3, utilizando Docker para desenvolvimento.

## Tecnologias Utilizadas

- **Backend**: Laravel (PHP)
- **Frontend**: Vue.js 3 + Inertia.js
- **Build Tool**: Vite
- **Containerização**: Docker + Docker Compose
- **Banco de Dados**: MySQL/PostgreSQL (configurável)

## Pré-requisitos

- Docker
- Docker Compose
- Git

## Instalação e Configuração

### 1. Clone o repositório
```bash
git clone <repository-url>
cd phpvue
```

### 2. Configure o ambiente Docker
Execute o script de configuração automática:
```bash
./docker.sh
```

Este script irá:
- Detectar automaticamente o UID/GID do usuário
- Criar o arquivo `.env.local` com as configurações corretas
- Gerar o arquivo `docker-compose.override.yml`

### 3. Inicie os containers
```bash
docker-compose up -d
```

### 4. Configure o Laravel
```bash
# Acesse o container da aplicação
docker-compose exec app bash

# Instale as dependências do PHP
composer install

# Gere a chave da aplicação
php artisan key:generate

# Execute as migrações
php artisan migrate

# Limpe o cache (se necessário)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### 5. Configure o frontend
```bash
# Acesse o container Node.js
docker-compose exec app-node bash

# Instale as dependências do Node.js
npm install

# Inicie o servidor de desenvolvimento
npm run dev
```

## Scripts Disponíveis

### Frontend (Node.js)
- `npm run dev` - Inicia o servidor de desenvolvimento Vite
- `npm run build` - Compila para produção
- `npm run preview` - Visualiza a build de produção

### Backend (PHP)
- `php artisan serve` - Servidor de desenvolvimento Laravel
- `php artisan migrate` - Executa migrações do banco
- `php artisan config:clear` - Limpa cache de configuração
- `php artisan cache:clear` - Limpa cache da aplicação

## Estrutura do Projeto

```
├── app/                    # Código Laravel (Controllers, Models, etc.)
├── resources/
│   ├── js/
│   │   └── src/           # Código Vue.js
│   │       ├── components/ # Componentes Vue
│   │       ├── views/     # Páginas Vue
│   │       ├── layouts/   # Layouts da aplicação
│   │       └── main.js    # Entrada principal do Vue
│   └── views/             # Templates Blade
├── public/                # Assets públicos
├── docker/                # Configurações Docker
├── docker-compose.yml     # Configuração principal do Docker
└── vite.config.mjs       # Configuração do Vite
```

## Desenvolvimento

### Acessando a aplicação
- **Frontend**: http://localhost:5173 (desenvolvimento)
- **Backend**: http://localhost:8000 (se rodando artisan serve)

### Containers Docker
- `app` - Container PHP/Laravel
- `app-node` - Container Node.js/Vite
- `db` - Container do banco de dados

### Hot Reload
O Vite está configurado com hot reload automático. Qualquer alteração nos arquivos Vue.js será refletida instantaneamente no browser.

### Comandos úteis
```bash
# Ver logs dos containers
docker-compose logs -f

# Parar os containers
docker-compose down

# Reconstruir os containers
docker-compose up --build

# Acessar container específico
docker-compose exec app bash
docker-compose exec app-node bash
```

## Produção

Para deploy em produção:

1. Configure as variáveis de ambiente adequadas
2. Execute o build do frontend:
   ```bash
   npm run build
   ```
3. Configure o servidor web (Nginx/Apache) para servir os assets estáticos
4. Execute as migrações e otimizações do Laravel:
   ```bash
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Segurança

- Todas as dependências npm foram auditadas e vulnerabilidades corrigidas
- Configurações de segurança implementadas no `package.json` com overrides
- Configuração Docker com usuário não-root

## Troubleshooting

### Erro de permissões Docker
Se encontrar problemas de permissão, execute novamente:
```bash
./docker.sh
docker-compose down
docker-compose up --build
```

### Erro 500 no Laravel
Limpe os caches:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### Erro de inicialização JavaScript
Reconstrua os assets:
```bash
npm run build
```

## Contribuição

1. Faça fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## License

Este projeto está licenciado sob a [MIT license](https://opensource.org/licenses/MIT).