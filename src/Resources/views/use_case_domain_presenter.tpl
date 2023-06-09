<?php
declare(strict_types=1);

namespace App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\Contract;

use App\{{boundedContext}}\Domain\UseCases\{{useCaseName}}\{{useCaseName}}{{boundedContext}}Response;

interface {{useCaseName}}{{boundedContext}}PresenterContract
{
    public function present({{useCaseName}}{{boundedContext}}Response $response);
}
