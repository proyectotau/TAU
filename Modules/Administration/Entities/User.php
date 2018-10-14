<?php

namespace Modules\Administration\Entities;

use Modules\Administration\Repositories\Repository;

//TODO: MUST implements Repository instead of extends Illuminate\Database\Eloquent\Model
//TODO: interface Respository in Modules/Administration/Repositories/
//TODO: implementation in Modules/Administration/Repositories/Eloquent
abstract class User implements Repository
{
}
