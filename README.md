<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

















Quero continuar o desenvolvimento do meu sistema Laravel + Vue + Inertia.

Estamos trabalhando no CRUD de Pessoas.

Minha arquitetura atual é:

Vue/Inertia
    ↓
Controller
    ↓
FormRequest
    ↓
Service
    ↓
Model
    ↓
MySQL


Quero melhorar a validação usando FormRequest do Laravel, deixando o backend como responsável principal pelas regras de validação.

O que quero fazer

Quero implementar:

StorePessoaRequest para cadastro.
UpdatePessoaRequest para edição.
Mensagens de validação personalizadas em português.
Validação de CPF.
Validação de CPF único.
No update, permitir que a pessoa mantenha o próprio CPF sem gerar erro de duplicidade.
Validação de telefone.
Validação de CEP.
Validação dos campos obrigatórios.
Validação do tipo_atendimento.
Validação do estado.
Fazer o Laravel devolver os erros automaticamente para o Vue através do Inertia.
No Vue, usar form.errors para mostrar os erros nos respectivos campos.
Evitar duplicar no Vue as regras que já existem no Laravel.
Manter no Vue apenas máscaras e melhorias de experiência do usuário quando fizer sentido.
Campos da tabela pessoas
$table->id();
$table->string('nome');
$table->string('cpf')->unique();
$table->string('telefone');
$table->string('tipo_atendimento');

Campos da tabela de endereços
$table->id();

$table->foreignId('pessoa_id')
    ->unique()
    ->constrained()
    ->cascadeOnDelete();

$table->string('cep', 9);
$table->string('logradouro');
$table->string('numero', 10);
$table->string('complemento')->nullable();
$table->string('bairro');
$table->string('cidade');
$table->char('estado', 2);

Valores de tipo_atendimento usados atualmente
Consulta
Exame
Emergência
Retorno

Meu Controller atual
<?php

namespace App\Http\Controllers;

use App\Services\PessoaService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PessoaController extends Controller
{
    public function __construct(
        private PessoaService $pessoaService
    ) {
    }

    public function index()
    {
        $pessoas = $this->pessoaService->listar();

        return Inertia::render('Pessoas/Index', [
            'pessoas' => $pessoas,
        ]);
    }

    public function create()
    {
        return Inertia::render('Pessoas/Create');
    }

    public function store(Request $request)
    {
        $this->pessoaService->criar(
            $request->all(),
        );

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function show(int $id)
    {
        $pessoa = $this->pessoaService->buscarPorId($id);

        return Inertia::render('Pessoas/Show', [
            'pessoa' => $pessoa,
        ]);
    }

    public function edit(int $id)
    {
        $pessoa = $this->pessoaService->buscarPorId($id);

        return Inertia::render('Pessoas/Edit', [
            'pessoa' => $pessoa,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->pessoaService->atualizar(
            $id,
            $request->all()
        );

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso!');
    }

    public function destroy(int $id)
    {
        $this->pessoaService->excluir($id);

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa removida com sucesso!');
    }
}


Quero que você me ajude a refatorar esse Controller para usar:

StorePessoaRequest


no store() e:

UpdatePessoaRequest


no update().

Também quero que você analise meu PessoaService antes de fazer mudanças, porque não quero quebrar a arquitetura atual.

Quero que o fluxo final fique assim:

Create.vue
    ↓
POST /pessoas
    ↓
StorePessoaRequest
    ↓
PessoaController
    ↓
PessoaService
    ↓
MySQL


E:

Edit.vue
    ↓
PUT/PATCH /pessoas/{id}
    ↓
UpdatePessoaRequest
    ↓
PessoaController
    ↓
