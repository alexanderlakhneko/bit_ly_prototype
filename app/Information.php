<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Information extends Model
{
    protected $fillable = ['link_id', 'headers', 'user_agent', 'ip', 'region'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo('App\Link', 'link_id');
    }

    /**
     * Store request data in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function saveRequest (Request $request, int $id): void
    {
        $model = new static();
        $ip = $request->ip();
        $location = \Location::get($ip);

        $model->link_id = $id;
        $model->headers = serialize($request->header());
        $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $model->ip = $ip;
        if($location) {
            $model->region = $location->regionName;
        }
        $model->save();
    }



    /**
     * Return Information object with count redirection
     *
     * @return $this
     */
    public function getCount()
    {
        return $this->with('link')->groupBy('link_id')->select('link_id', \DB::raw('count(link_id) as total'));
    }
}
