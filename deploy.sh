#!/bin/bash

echo "🚀 Iniciando processo de deploy..."

cd /var/www/vision-track || { echo "❌ Pasta do projeto não encontrada!"; exit 1; }

echo "📥 Verificando atualizações no repositório Git..."

# Salva o hash atual do último commit
OLD_COMMIT=$(git rev-parse HEAD)

# Puxa alterações
git pull origin main || { echo "❌ Falha ao executar git pull"; exit 1; }

# Salva novo hash e compara
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

# --- JS Dependencies e Build ---
NEED_BUILD=false

if [ ! -d node_modules ]; then
    NEED_BUILD=true
elif git diff --name-only "$OLD_COMMIT" "$NEW_COMMIT" | grep -E '\.vue$|\.js$|\.ts$|vite\.config\.js'; then
    NEED_BUILD=true
fi

if $NEED_BUILD; then
    echo "📦 Alterações detectadas em arquivos front-end. Instalando dependências e buildando front..."
    yarn install --frozen-lockfile
    yarn build
else
    echo "📦 Nenhuma alteração relevante no front-end detectada. Ignorando build."
fi

# echo "🔧 Ajustando permissões..."
# sudo chown -R edipoelwes:edipoelwes storage bootstrap/cache
# sudo chmod -R 775 storage bootstrap/cache

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
