<?php declare(strict_types=1);

class View
{
    protected array $data;
    public function RenderView(string $template,$view,array $data = []) : string|false
    {
        $this->data = $data;

        $viewContent = $this->RenderViewOnly($view);
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . "/src/views/templates/" . $template . ".php";
        $templateContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $templateContent);


    }
    public function RenderViewOnly(string $view): string|false
    {
        ob_start();
        include $_SERVER['DOCUMENT_ROOT']."/src/views/".$view.".php";
        return ob_get_clean();
    }
}
