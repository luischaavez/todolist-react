<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'body', 'completed', 'owner_id' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * Changes the current state of the todo to 'complete'
     */
    public function markAsComplete()
    {
        if(! $this->completed) {
            return $this->update([
                'completed' => true,
            ]);
        }   
    }
}
