<?php

declare(strict_types=1);

namespace App\{{boundedContext}}\Framework\View\{{useCaseName}};

use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Request;
use App\{{boundedContext}}\Presentation\{{useCaseName}}\Http\{{useCaseName}}{{boundedContext}}HtmlViewModel;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

final class {{useCaseName}}{{boundedContext}}HtmlView
{
    private Environment $twig;
    private FormFactoryInterface $formFactory;
    private string $template = '';

    public function __construct(
        Environment $twig,
        FormFactoryInterface $formFactory
    ) {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->template = '';

}

    public function generateView(
        {{useCaseName}}{{boundedContext}}Request $request,
        {{useCaseName}}{{boundedContext}}HtmlViewModel $viewModel
    ): Response {
        $data = [];

        if (!$viewModel->violations && $request->isPosted) {
            return new Response($this->twig->render($this->template, $data));
        }

        $form = $this->formFactory->createBuilder(FormType::class, $request)->getForm();
        $data['form']= $form;


        return new Response($this->twig->render($this->template, [
            'controller_name' => 'PageResolverController',
        ]));
    }
}
