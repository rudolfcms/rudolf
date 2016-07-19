<?php
namespace Rudolf\Component\ErrorHandler\Handler;

class PlainTextHandler extends Handler implements IHandler
{
	public function handle($exception)
    {
        $this->exception = $exception;

        echo $this->formatMessage();
    }

    /**
     * Format message
     *
     * @return string
     */
    private function formatMessage()
    {
        $description = $this->getDescription();

        return sprintf("%s: %s in %s:%d\n%s\n",
            $description['class'],
            $description['message'],
            $description['file'],
            $description['line'],
            $this->formatTrace($this->getTrace())
        );
    }

    /**
     * Format trace
     *
     * @param array $trace
     *
     * @return string
     */
    private function formatTrace($trace)
    {
        foreach ($trace as $key => $value) {
            $t[] = sprintf('- %1$s:%2$s %3$s%4$s%5$s ',
                $value['file'],
                $value['line'],
                $value['class'],
                $value['type'],
                $value['function']
            );
        }
        return implode("\n", $t);
    }
}
