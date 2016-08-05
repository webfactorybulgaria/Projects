<?php

namespace TypiCMS\Modules\Projects\Models;

use TypiCMS\Modules\Core\Custom\Models\BaseTranslation;

class ProjectTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Projects\Custom\Models\Project', 'project_id')->withoutGlobalScopes();
    }
}
