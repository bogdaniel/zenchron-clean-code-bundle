<?php

declare(strict_types=1);

namespace App\{{boundedContext}}\Framework\View\{{useCaseName}};

use App\{{boundedContext}}\Presentation\{{useCaseName}}\Api\{{useCaseName}}{{boundedContext}}JsonViewModel;

use Symfony\Component\HttpFoundation\JsonResponse;

final class {{useCaseName}}{{boundedContext}}JsonView
{
    public function generateView({{useCaseName}}{{boundedContext}}JsonViewModel $viewModel): JsonResponse {
        if ($viewModel->violations) {
            return new JsonResponse($viewModel->violations, 400);
        }

        return new JsonResponse([]);
    }
}
