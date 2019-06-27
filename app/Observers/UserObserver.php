<?php

namespace App\Observers;

/**
 * Observes the Users model
 */

use App\User;

class UserObserver
{
    /**
     * Function will be triggerd when a user is updated
     *
     * @param Users $model
     */
    public function creating(User $model)
    {
        $model->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }


     public function updated($model)
     {
         // execute your own code
     }
}
