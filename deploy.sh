#!/bin/bash

echo "🚀 Iniciando processo de deploy..."

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

echo "📥 Verificando yarn:"
which yarn || { echo "❌ yarn não encontrado no PATH"; exit 1; }

cd /var/www/vision-track || { echo "❌ Pasta do projeto não encontrada!"; exit 1; }

echo "📥 Verificando atualizações no repositório Git..."

OLD_COMMIT=$(git rev-parse HEAD)
git pull origin main || { echo "❌ Falha ao executar git pull"; exit 1; }
NEW_COMMIT=$(git rev-parse HEAD)

if [ "$OLD_COMMIT" = "$NEW_COMMIT" ]; then
    echo "📦 Nenhuma nova alteração no repositório. Encerrando..."
    exit 0
fi

echo "🔄 Novas alterações detectadas. Iniciando processo..."

echo "📦 Instalando dependências PHP..."
composer install --no-dev --optimize-autoloader || { echo "❌ Falha no composer install"; exit 1; }

echo "📦 Instalando dependências JS..."
yarn install --frozen-lockfile || { echo "❌ Falha no yarn install"; exit 1; }

echo "📦 Rodando build do front-end..."
yarn build || { echo "❌ Falha no yarn build"; exit 1; }

echo "🔁 Rodando migrations..."
php artisan migrate --force || { echo "❌ Falha nas migrations"; exit 1; }

echo "🧹 Limpando e otimizando cache do Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deploy concluído com sucesso!"
