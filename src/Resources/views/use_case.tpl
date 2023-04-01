<?php

declare(strict_types=1);

namespace App\{{boundedContext}}\Domain\UseCases\{{useCaseName}};

use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract\{{useCaseName}}{{boundedContext}}UseCaseContract;
use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract\{{useCaseName}}{{boundedContext}}PresenterContract;

final class {{useCaseName}}{{boundedContext}}UseCase implements {{useCaseName}}{{boundedContext}}UseCaseContract
{
    public function execute({{useCaseName}}{{boundedContext}}Request $request, {{useCaseName}}{{boundedContext}}PresenterContract $presenter): void
    {
        // TODO: Implement execute() method.
    }
}
