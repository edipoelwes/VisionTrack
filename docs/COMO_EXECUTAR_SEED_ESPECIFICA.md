# Como Executar uma Seed Específica no Laravel

## Comando Básico

Para executar uma seed específica no Laravel, use o comando `php artisan db:seed` com a opção `--class`:

```bash
php artisan db:seed --class=NomeDaSeeder
```

## Exemplos com Seeders do Projeto

Para executar seeders específicos deste projeto, use os seguintes comandos:

### CompanySeeder
```bash
php artisan db:seed --class=Database\\Seeders\\CompanySeeder
```

### ClientSeeder
```bash
php artisan db:seed --class=Database\\Seeders\\ClientSeeder
```

### Outros Seeders Disponíveis
```bash
php artisan db:seed --class=Database\\Seeders\\PrescriptionSeeder
php artisan db:seed --class=Database\\Seeders\\AddressSeeder
php artisan db:seed --class=Database\\Seeders\\SaleSeeder
```

## Observações Importantes

1. **Namespace Completo**: Note que é necessário usar o namespace completo da classe, incluindo `Database\\Seeders\\`.

2. **Dependências entre Seeders**: Alguns seeders dependem de outros. Por exemplo, o `ClientSeeder` depende do `CompanySeeder`. Se você executar um seeder que depende de dados criados por outro seeder, certifique-se de executar primeiro o seeder do qual ele depende.

3. **Opções Adicionais**:
   - Para ver todas as opções disponíveis: `php artisan db:seed --help`
   - Para executar em modo silencioso: `php artisan db:seed --class=Database\\Seeders\\CompanySeeder --quiet`
   - Para executar em ambiente específico: `php artisan db:seed --class=Database\\Seeders\\CompanySeeder --env=testing`

4. **Executar Múltiplos Seeders**: Se você precisar executar múltiplos seeders específicos, execute os comandos separadamente em sequência.

## Recriar o Banco de Dados e Executar Todas as Migrations e Seeds

Se você quiser recriar todo o banco de dados, execute:

```bash
php artisan migrate:fresh --seed
```

Para recriar o banco de dados e executar apenas um seeder específico:

```bash
php artisan migrate:fresh --seed --seeder=Database\\Seeders\\CompanySeeder
```

## Dicas

- Sempre faça backup do seu banco de dados antes de executar seeders em ambiente de produção.
- Para desenvolvimento, considere usar `migrate:fresh --seed` para garantir um estado consistente do banco de dados.
