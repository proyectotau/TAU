<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 21/04/2018
 * Time: 22:47
 */

namespace Modules\Administration\Repositories;

use Illuminate\Support\Collection;

class Model extends Collection implements Repository
{
    private function pendingImplementation($method){
        echo 'Modules\Administration\Repositories\Model::'.$method.': pending of Implementation'.PHP_EOL;
        return;
    }

    /**
     * Get the queueable identity for the entity.
     *
     * @return mixed
     */
    public function getQueueableId()
    {
        // TODO: Implement getQueueableId() method.
        return $this->pendingImplementation('getQueueableId()');
    }

    /**
     * Get the relationships for the entity.
     *
     * @return array
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
        return $this->pendingImplementation('getQueueableRelations()');
    }

    /**
     * Get the connection of the entity.
     *
     * @return string|null
     */
    public function getQueueableConnection()
    {
        // TODO: Implement getQueueableConnection() method.
        return $this->pendingImplementation('getQueueableConnection');
    }

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        // TODO: Implement getRouteKey() method.
        return $this->pendingImplementation('getRouteKey()');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        // TODO: Implement getRouteKeyName() method.
        return $this->pendingImplementation('getRouteKeyName()');
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        // TODO: Implement resolveRouteBinding() method.
        return $this->pendingImplementation("resolveRouteBinding($value)");
    }
}