<?php
namespace App;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;

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
        $routerListener = new RouterListener($matcher, new RequestStack());
        $dispatcher->addSubscriber($routerListener);

        $kernel = new HttpKernel($dispatcher, new ControllerResolver(), new RequestStack(), new ArgumentResolver());
        try{
            $response = $kernel->handle($request);
        } catch (NotFoundHttpException  $exception) {
            $response = new Response('Страница не найдена', Response::HTTP_NOT_FOUND);
        }
        $response->send();

        $kernel->terminate($request, $response);
    }
}
