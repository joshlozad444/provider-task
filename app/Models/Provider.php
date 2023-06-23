<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * Overriding defaults $table, $primaryKey and $timestamps
     * By convention, current values for $table and $primaryKey is already Eloquent's default
     * but doing this just in case values are to be changed.
     */
    protected $table = 'providers';

    protected $primaryKey = 'provider_id';

    /**
     * override default "timestamp"-ing
     */
    public $timestamps = false;

    /**
     * set fillable property to enable mass assignment: Provider::create
     */
    protected $fillable = ['provider_name', 'provider_url'];
}
