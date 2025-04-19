
# BladeSlim

Integração do Blade Template Engine com Slim Framework

![PHP Version](https://img.shields.io/badge/php-%3E=8.4-blue)
![License](https://img.shields.io/badge/license-MIT-green)

Um pacote que integra perfeitamente o mecanismo de templates Blade do Laravel com o Slim Framework, proporcionando uma experiência de desenvolvimento fluida com todos os recursos do Blade em aplicações Slim.

## 📦 Instalação

Instale via Composer:

```bash
composer require caiquebispo/blade-slim
```

## 🚀 Configuração Rápida

Configure o Blade no seu aplicativo Slim:

```php
use BladeSlim\Blade;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// Configuração do Blade
$blade = new Blade(
    __DIR__ . '/resources/views', // Diretório de views
    __DIR__ . '/storage/cache',   // Diretório de cache
    $app->getResponseFactory()->createResponse() // Response prototype
);
```

Crie sua primeira view em `resources/views/home.blade.php`:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>Bem-vindo ao {{ $appName }}!</h1>
</body>
</html>
```

Use em uma rota:

```php
$app->get('/', function () {
    return view('home', [
        'title' => 'Página Inicial',
        'appName' => 'Meu App Slim'
    ]);
});
```

## ✨ Recursos Principais

### ✅ Função Global `view()`

Retorna automaticamente uma resposta PSR-7 pronta.

Suporte a dados, status code e headers:

```php
return view('error', ['message' => 'Não encontrado'], 404);
```

### ✅ Todos os Recursos do Blade

- Herança de templates (`@extends`)
- Seções (`@section`, `@yield`)
- Componentes (`@component`)
- Diretivas personalizáveis
- Inclusão de sub-views (`@include`)

### ✅ Configuração Flexível

- Múltiplos caminhos de views
- Cache opcional
- Integração com container DI do Slim

## 📚 Uso Avançado

### 🔧 Diretivas Personalizadas

```php
$blade->getFactory()->directive('datetime', function ($expression) {
    return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
});
```

## 🤝 Contribuição

Contribuições são bem-vindas! Siga estes passos:

1. Faça um fork do projeto
2. Crie sua branch (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Distribuído sob a licença MIT. Veja `LICENSE` para mais informações.

## 📧 Contato

Caique Bispo - caiquebispodanet86@gmail.com

Link do Projeto: [https://github.com/caiquebispo/blade-slim](https://github.com/caiquebispo/blade-slim)
