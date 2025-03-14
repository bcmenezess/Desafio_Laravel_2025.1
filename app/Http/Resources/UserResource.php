<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(isset($this['photo'])){
            $this['photo'] = 'storage/'.$this['photo'];
        }
        else{
            $this['photo'] = 'Sem foto';
        }

        return [
            'name' => $this['name'],
            'photo' => $this['photo']
        ];
    }
}
