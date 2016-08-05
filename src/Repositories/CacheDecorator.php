<?php

namespace TypiCMS\Modules\Projects\Repositories;

use TypiCMS\Modules\Core\Custom\Repositories\CacheAbstractDecorator;
use TypiCMS\Modules\Core\Custom\Services\Cache\CacheInterface;

class CacheDecorator extends CacheAbstractDecorator implements ProjectInterface
{
    public function __construct(ProjectInterface $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
