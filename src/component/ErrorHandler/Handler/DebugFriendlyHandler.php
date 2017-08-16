<?php

namespace Rudolf\Component\ErrorHandler\Handler;

class DebugFriendlyHandler extends Handler implements IHandler
{
    /**
     * @var string
     */
    private $pageTitle;

    /**
     * @var string
     */
    private $pageStyle;

    /**
     * @var string
     */
    private $pageScript;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $description;

    /**
     * @var array
     */
    private $trace;

    public function handle()
    {
        $this->pageTitle = 'Oh no! Error occurred!';
        $this->pageStyle = $this->getResource(['css/reset.css', 'css/style.css']);
        $this->pageScript = $this->getResource(['js/checkargs.js']);
        $this->message = $this->getException()->getMessage();
        $this->description = $this->getDescription();
        $this->trace = $this->getTrace();

        echo $this->includeFile('templates/layout.html.php');
    }

    /**
     * Get resource.
     *
     * @param string|array $name
     * @param bool         $include
     *
     * @return string
     */
    private function getResource($name)
    {
        $t = [];

        foreach ($name as $key => $value) {
            $t[] = file_get_contents(__DIR__.'/../Resources/'.$value);
        }

        return implode('', $t);
    }

    /**
     * Include template file.
     *
     * @param string $file
     *
     * @return string
     */
    private function includeFile($file) {
        ob_start();

        include __DIR__.'/../Resources/'.$file;

        return ob_get_clean();
    }
}
