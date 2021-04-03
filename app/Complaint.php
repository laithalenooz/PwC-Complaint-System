<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [ 'type', 'days', 'image', 'location', 'time', 'description', 'status', 'user_id' ];

    /**
     * Set the Types
     *
     */
    public function setTypeAttribute( $value )
    {
        $this->attributes[ 'type' ] = json_encode( $value );
    }

    /**
     * Get the Types
     *
     */
    public function getTypeAttribute( $value )
    {
        return $this->attributes[ 'type' ] = json_decode( $value );
    }

    /**
     * Set the Types
     *
     */
    public function setDaysAttribute( $value )
    {
        $this->attributes[ 'days' ] = json_encode( $value );
    }

    /**
     * Get the Types
     *
     */
    public function getDaysAttribute( $value )
    {
        return $this->attributes[ 'days' ] = json_decode( $value );
    }

    protected $hidden = [ 'id' ];

    public function user()
    {
        // Create the relationship between user and complaint
        return $this->belongsTo( User::class, 'user_id' );
    }
}
