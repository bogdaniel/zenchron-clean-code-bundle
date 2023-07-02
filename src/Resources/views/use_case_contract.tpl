<?php
declare(strict_types=1);

namespace App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract;

use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Request;

interface {{useCaseName}}{{boundedContext}}UseCaseContract
{
    public function execute({{useCaseName}}{{boundedContext}}Request $request, {{useCaseName}}{{boundedContext}}PresenterContract $presenter): void;
}
