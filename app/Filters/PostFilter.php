<?php

namespace App\Filters;

class PostFilter extends QueryFilter{

    // public function user_id($id = null){
    //     return $this->builder->when($id, function($query) use($id){
    //         $query->where('user_id', $id);
    //     });
    // }

    public function search_field($search_string = ''){
        return $this->builder
            ->where('title', 'LIKE', '%'.$search_string.'%');
            // ->whereHas('hashtags', fn($q)=>$q->where('name', 'LIKE', '%'.$search_string.'%'));
    }

    public function search_hashtag($search_string = ''){
        return $this->builder
            ->whereHas('hashtags', fn($q)=>$q->where('name', 'LIKE', '%'.$search_string.'%'));
    }
}