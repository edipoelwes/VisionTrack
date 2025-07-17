#!/bin/bash

echo "🚀 Iniciando processo de deploy..."

# Configura NVM para garantir que node/yarn estejam disponíveis
export NVM_DIR="$HOME/.nvm"
if [ -s "$NVM_DIR/nvm.sh" ]; then
    \. "$NVM_DIR/nvm.sh"
fi
if [ -s "$NVM_DIR/bash_completion" ]; then
    \. "$NVM_DIR/bash_completion"
fi

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

# Composer install apenas se o composer.lock mudou
if git diff --name-only "$OLD_COMMIT" "$NEW_COMMIT" | grep -q '^composer.lock$'; then
    echo "📦 composer.lock alterado. Instalando dependências PHP..."
    composer install --no-dev --optimize-autoloader || { echo "❌ Falha no composer install"; exit 1; }
else
    echo "📦 composer.lock não alterado. Pulando composer install."
fi

# Yarn install apenas se yarn.lock mudou
if git diff --name-only "$OLD_COMMIT" "$NEW_COMMIT" | grep -q '^yarn.lock$'; then
    echo "📦 yarn.lock alterado. Instalando dependências JS..."
    yarn install --frozen-lockfile || { echo "❌ Falha no yarn install"; exit 1; }
else
    echo "📦 yarn.lock não alterado. Pulando yarn install."
fi

# Rodar build apenas se arquivos do front forem alterados
if git diff --name-only "$OLD_COMMIT" "$NEW_COMMIT" | grep -Eq '^resources/(js|css|sass)/|^vite\.config\.js$|^tailwind\.config\.js$|^package\.json$'; then
    echo "📦 Alterações no front detectadas. Rodando build do front-end..."
    yarn build || { echo "❌ Falha no yarn build"; exit 1; }
else
    echo "📦 Nenhuma alteração no front detectada. Pulando build do front-end."
fi

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
