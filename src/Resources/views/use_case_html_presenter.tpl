<?php

declare(strict_types=1);

namespace App\{{boundedContext}}\Presentation\{{useCaseName}}\Http;

use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract\{{useCaseName}}{{boundedContext}}PresenterContract;
use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Response;

final class {{useCaseName}}{{boundedContext}}HtmlPresenter implements {{useCaseName}}{{boundedContext}}PresenterContract
{
    private {{useCaseName}}{{boundedContext}}HtmlViewModel $viewModel;

    public function present({{useCaseName}}{{boundedContext}}Response $response): void
    {
        $this->viewModel = new {{useCaseName}}{{boundedContext}}HtmlViewModel();
    }

    public function viewModel(): {{useCaseName}}{{boundedContext}}HtmlViewModel
    {
        return $this->viewModel;
    }
}
