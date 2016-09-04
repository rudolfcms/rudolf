<?php

namespace Rudolf\Component\ErrorHandler\Handler;

use Rudolf\Component\Http\ResponseMessages;
use Rudolf\Component\Http\Response;

class UserFriendlyHandler extends Handler implements IHandler
{
    public function handle()
    {
        $code = $this->getCode($this->getException());
        $texts = ResponseMessages::getMessages($code);

        $response = new Response($this->displayDefaultMessage($code, $texts[0], $texts[1]), $code);
        $response->setHeader(['cache-Control', 'no-cache, must-revalidate']);

        echo $response->send();
    }

    /**
     * Get code from exception.
     * 
     * @param Exception $e
     * 
     * @return int
     */
    public function getCode($e)
    {
        $code = $e->getCode();
        if (isset(Response::$statusTexts[$code])) {
            return $code;
        }
        return 503;
    }

    /**
     * Displays an error message in html.
     * 
     * @return string
     */
    public function displayDefaultMessage($code, $message, $text)
    {
        $code = $code;
        $message = _($message);
        $text = $text;
        $error = _('Code').' '.$code;
        $title = $error.' - '.$message;

        return
        '<!DOCTYPE html>'
            .'<meta charset="utf-8">'
            .'<title>'.$title.'</title>'
            .'<style>'
            .'body{background:#f1f1f1;font-family:Arial,sans-serif;color:#444}.c{max-width:500px;min-width:200px;margin:40px auto;padding:15px;background:#fff;box-shadow:1px 2px 3px #aaa}h1{font-weight:normal;margin:5px 10px 20px;}p{margin:10px;color:#555}.r{font-size:13px;text-align:right;font-style:italic;color:#aaa}'
            .'</style>'
            .'<div class="c">'
            .'<h1>'.$message.'</h1>'
            .'<p>'.$error.'</p>'
            .'<p>'.$text.'</p>'
            .'<p class="r">Rudolf</p>'
            .'</div>';
    }
}
