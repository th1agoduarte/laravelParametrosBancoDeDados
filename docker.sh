#!/bin/bash

# Script para facilitar o uso do Docker Compose com UID/GID automáticos
# Uso: ./docker.sh [comando docker-compose]
# Exemplos:
#   ./docker.sh up -d
#   ./docker.sh down
#   ./docker.sh ps
#   ./docker.sh logs

# Gera .env.local com UID/GID atuais
USER_UID=$(id -u)
USER_GID=$(id -g)

echo "UID=$USER_UID" > .env.local
echo "GID=$USER_GID" >> .env.local

# Gera docker-compose.override.yml automaticamente
cat > docker-compose.override.yml << EOF
# Arquivo gerado automaticamente pelo script docker.sh
# UID=$USER_UID GID=$USER_GID

services:
  app:
    build:
      args:
        uid: $USER_UID
        gid: $USER_GID
    user: "$USER_UID:$USER_GID"

  app-node:
    build:
      args:
        uid: $USER_UID
        gid: $USER_GID
    user: "$USER_UID:$USER_GID"
EOF

echo "🐳 Executando com UID=$USER_UID e GID=$USER_GID"

# Se nenhum argumento for passado, mostra ajuda
if [ $# -eq 0 ]; then
    echo "Uso: $0 [comando docker-compose]"
    echo ""
    echo "Comandos mais usados:"
    echo "  $0 up -d        # Subir containers em background"
    echo "  $0 down         # Parar e remover containers"
    echo "  $0 ps           # Ver status dos containers"
    echo "  $0 logs [nome]  # Ver logs dos containers"
    echo "  $0 exec app bash # Entrar no container PHP"
    echo "  $0 exec app-node bash # Entrar no container Node"
    exit 1
fi

# Executa o comando docker compose com as variáveis de ambiente
docker compose "$@"