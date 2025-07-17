#!/bin/bash

echo "🚀 Iniciando processo de deploy..."

cd /var/www/vision-track || { echo "❌ Pasta do projeto não encontrada!"; exit 1; }

echo "📥 Verificando atualizações no repositório Git..."

OLD_COMMIT=$(git rev-parse HEAD)
git pull origin main || { echo "❌ Falha ao executar git pull"; exit 1; }
NEW_COMMIT=$(git rev-parse HEAD)

if [ "$OLD_COMMIT" = "$NEW_COMMIT" ]; then
    echo "📦 Nenhuma nova alteração no repositório. Encerrando..."
    exit 0
else
    echo "🔄 Novas alterações detectadas. Continuando com o deploy..."
fi

# --- PHP Dependencies ---
if [ ! -d vendor ] || [ composer.lock -nt vendor ]; then
    echo "📦 Alterações detectadas no Composer. Instalando dependências..."
    composer install --no-dev --optimize-autoloader
else
    echo "📦 Nenhuma alteração nas dependências PHP detectada."
fi

# --- JS Dependencies ---
INSTALL_DEPS=false
if [ ! -d node_modules ] || [ package.json -nt node_modules ] || [ yarn.lock -nt node_modules ]; then
    INSTALL_DEPS=true
fi

if $INSTALL_DEPS; then
    echo "📦 Instalando dependências JS..."
    yarn install --frozen-lockfile
else
    echo "📦 Dependências JS atualizadas. Ignorando instalação."
fi

echo "📦 Rodando build do front-end..."
yarn build

echo "🔁 Rodando migrations..."
php artisan migrate --force

echo "🧹 Limpando e otimizando cache do Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deploy concluído com sucesso!"
