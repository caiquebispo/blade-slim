<?php

namespace BladeSlim;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class Blade
{
    protected Factory $factory;
    protected static ?Blade $instance = null;
    protected ResponseInterface $responsePrototype;

    public function __construct(string $viewsPath, string $cachePath, ?ResponseInterface $response = null)
    {
        $filesystem = new Filesystem;
        $resolver = new EngineResolver;

        $bladeCompiler = new BladeCompiler($filesystem, $cachePath);

        $resolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $resolver->register('php', function () {
            return new PhpEngine;
        });

        $finder = new FileViewFinder($filesystem, [$viewsPath]);

        $this->factory = new Factory($resolver, $finder, new Dispatcher(new Container));
        $this->factory->setContainer(new Container);

        $this->responsePrototype = $response ?? new Response();
        self::$instance = $this;
    }

    public function view(string $view, array $data = [], int $status = 200, array $headers = []): ResponseInterface
    {
        $content = $this->factory->make($view, $data)->render();
        $response = clone $this->responsePrototype;

        $response->getBody()->write($content);
        $response = $response->withStatus($status);

        foreach ($headers as $name => $value) {
            $response = $response->withHeader($name, $value);
        }

        return $response;
    }

    public static function getInstance(): ?Blade
    {
        return self::$instance;
    }

    public function getFactory(): Factory
    {
        return $this->factory;
    }
}