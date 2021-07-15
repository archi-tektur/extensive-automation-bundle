<?php

declare(strict_types=1);

namespace ArchTools\Bundle\ExtensiveAutomationBundle\Request;

use Symfony\Component\HttpFoundation\Request;

class InformationSourceMerger
{
    public static function buildFromRequest(Request $request): array
    {
        $routeParams = $request->attributes->get('_route_params');
        $content = json_decode($request->getContent(), true);

        $content['id'] = $routeParams['id'] ?? null;

        $typeIsDefined = array_key_exists('type', $routeParams) && null !== $routeParams['type'];

        if ($typeIsDefined) {
            $content['type'] = $routeParams['type'];
        }

        return $content;
    }
}
