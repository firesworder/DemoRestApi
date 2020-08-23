<?php
namespace App;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Kernel
{
    /**
     * @var RouteCollection;
     */
    private $routes;

    public function __construct()
    {
        $projectDir = getenv('PROJECT_DIR');
        $fileLocator = new FileLocator([$projectDir . '/config/']);
        $yamlLoader = new YamlFileLoader($fileLocator);
        $this->routes = $yamlLoader->load('routes.yaml');
    }

    public function execute()
    {
        $request = Request::createFromGlobals();

        $matcher = new UrlMatcher($this->routes, new RequestContext());

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

        $kernel = new HttpKernel($dispatcher, new ControllerResolver(), new RequestStack(), new ArgumentResolver());

        $response = $kernel->handle($request);
        $response->send();

        $kernel->terminate($request, $response);
    }
}
