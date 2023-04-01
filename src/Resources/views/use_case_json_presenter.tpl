<?php

declare(strict_types=1);

namespace App\{{boundedContext}}\Presentation\{{useCaseName}}\Api;


use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract\{{useCaseName}}{{boundedContext}}PresenterContract;
use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Response;

final class {{useCaseName}}{{boundedContext}}JsonPresenter implements {{useCaseName}}{{boundedContext}}PresenterContract
{
    private RegisterUserJsonViewModel $viewModel;

    public function present({{useCaseName}}{{boundedContext}}Response $response): void
    {
        $this->viewModel = new {{useCaseName}}{{boundedContext}}JsonViewModel();
    }

    public function viewModel(): {{useCaseName}}{{boundedContext}}JsonViewModel
    {
        return $this->viewModel;
    }
}
