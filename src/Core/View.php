<?php

namespace App\Core;

use App\TwigExtension\AppExtension;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
    private static $instance = null;
    private $loader = null;
    private $twig = null;
    private $viewPath = '%s/View';

    private function __construct()
    {
        $this->loader = new FilesystemLoader(sprintf($this->viewPath, APP_ROOT));
        $this->initializeTwigEnvironment();
    }

    private function initializeTwigEnvironment(): void
    {
        $options = [];
        $this->twig = new Environment($this->loader, $options);
        if (TWIG_DEBUG) {
            $this->twig->enableDebug();
            $this->twig->addExtension(new DebugExtension());
        }
        $this->twig->addExtension(new AppExtension());
    }

    /**
     * @return View|null
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new View();
        }
        return self::$instance;
    }

    /**
     * @param array $data
     * @param null $twigFile
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public static function render($data = [],$twigFile = null)
    {
        $obj = self::getInstance();
        $obj->getTemplateName();
        return $obj->twig->render($obj->getTemplateName(), $data);
    }

    /**
     * @return string
     */
    private function getTemplateName()
    {
        $trace = debug_backtrace();
        $controller = str_replace(ConfigConstants::APP_CONTROLLER_SUFFIX,'',$this->getControllerName($trace));
        $method = $this->getControllerMethodName($trace);
        return sprintf("%s/%s", $controller, $method);
    }

    /**
     * @param array $trace
     * @return string|null
     */
    private function getControllerName(array $trace): ?string
    {
        if (isset($trace[2]['object'])) {
            $parts = explode('\\', get_class($trace[2]['object']));
            return ucfirst(end($parts));
        }
        return null;
    }

    /**
     * @param array $trace
     * @return string|null
     */
    private function getControllerMethodName(array $trace): ?string
    {
        $method = null;
        if (isset($trace[1]['args'][1])) {
            $method = $trace[1]['args'][1];
        }
        if ($method == null && isset($trace[2]['function'])) {
            $method = $trace[2]['function'];
            return $method = str_replace(ConfigConstants::APP_CONTROLLER_METHOD_SUFFIX, '.html.twig', $method);
        }
        return $method;
    }
}
