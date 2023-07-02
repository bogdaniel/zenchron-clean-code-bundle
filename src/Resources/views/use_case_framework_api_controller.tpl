<?php
declare(strict_types=1);

namespace App\{{boundedContext}}\Framework\Controller\{{useCaseName}}\Api;

use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract\{{useCaseName}}{{boundedContext}}UseCaseContract;
use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Request;
use App\{{boundedContext}}\Framework\View\{{useCaseName}}\{{useCaseName}}{{boundedContext}}HtmlView;
use App\{{boundedContext}}\Presentation\{{useCaseName}}\Http\NewFolderFileManagerHtmlPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[Route('/', name: 'app')]
final class {{useCaseName}}{{boundedContext}}Controller extends AbstractController
{
    private {{useCaseName}}{{boundedContext}}HtmlView $registerView;
    private {{useCaseName}}{{boundedContext}}UseCaseContract $useCase;
    private {{useCaseName}}{{boundedContext}}HtmlPresenter $presenter;

    public function __construct(
        {{useCaseName}}{{boundedContext}}HtmlView $registerView,
        {{useCaseName}}{{boundedContext}}UseCaseContract $useCase,
        {{useCaseName}}{{boundedContext}}HtmlPresenter $presenter
    ) {
        $this->registerView = $registerView;
        $this->useCase = $useCase;
        $this->presenter = $presenter;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke({{useCaseName}}{{boundedContext}}Request $request): Response
    {
        $this->useCase->execute($request, $this->presenter);

        return $this->registerView->generateView(
            $request,
            $this->presenter->viewModel()
        );
    }
}
