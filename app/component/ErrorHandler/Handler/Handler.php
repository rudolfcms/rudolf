<?php
namespace Rudolf\Component\ErrorHandler\Handler;

abstract class Handler
{
    /**
     * Get exception information
     *
     * @return array
     */
	public function getDescription()
    {
        return [
            'class' => get_class($this->exception),
            'message' => $this->exception->getMessage(),
            'file' => str_replace(WEB_ROOT, '', $this->exception->getFile()),
            'line' => $this->exception->getLine()
        ];
    }

    /**
     * Get strac trace
     *
     * @return array
     */
    public function getTrace()
    {
        $exception = $this->exception;
        $trace = $exception->getTrace();

        foreach ($trace as $key => $value) {
            $log[] = [
                'file' => str_replace(WEB_ROOT, '', isset($value['file']) ? $value['file'] : ''),
                'line' => isset($value['line']) ? $value['line'] : '',
                'class' => isset($value['class']) ? $value['class'] : '',
                'type' => isset($value['type']) ? $value['type'] : '',
                'function' => isset($value['function']) ? $value['function'] : '',
                // 'args' => str_replace(WEB_ROOT, '', var_export($value['args'], true))
                'args' => ''
            ];
        }

        array_unshift($log, [
            'file' => str_replace(WEB_ROOT, '', $exception->getFile()),
            'line' => $exception->getLine(),
            'class' => $log[0]['class'],
            'type' => $log[0]['type'],
            'function' => $log[0]['function'],
            // 'args' => str_replace(WEB_ROOT, '', var_export($log[0]['args'], true))
            'args' => ''
        ]);

        array_splice($log, 1, 1);

        return array_reverse($log);
    }
}
