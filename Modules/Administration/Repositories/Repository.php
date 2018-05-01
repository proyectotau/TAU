<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 20/04/2018
 * Time: 1:16
 */

namespace Modules\Administration\Repositories;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
/*
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
*/

interface Repository extends ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    //TODO: Extends from Eloquent's methods

    /*use Concerns\HasAttributes,
        Concerns\HasEvents,
        Concerns\HasGlobalScopes,
        Concerns\HasRelationships,
        Concerns\HasTimestamps,
        Concerns\HidesAttributes,
        Concerns\GuardsAttributes;*/


    /**
     * Dynamically retrieve attributes on the model.
     */
    //public function __get(string $key): mixed;

    /**
     * Dynamically set attributes on the model.
     */
    //public function __set(string $key, mixed $value): void;

    /**
     * Get all of the models from the Repository.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    //public function all($columns = ['*']): mixed;

    //public function find(int $id, array $columns = ['*']);
}