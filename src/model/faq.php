<?php

namespace Bageur\FAQ\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class faq extends Model
{
    protected $table = 'bgr_faq';

    protected $appends = ['text_limit'];

    public function getTextLimitAttribute() {
        $text = strip_tags($this->jawaban);
        return Str::limit($text,80);
        // return Str::limit(\Bageur::toText($this->text),150);
   }

    public function scopeDatatable($query,$request,$page=12)
    {
          $search       = ["pertanyaan"];
          $searchqry    = '';

        $searchqry = "(";
        foreach ($search as $key => $value) {
            if($key == 0){
                $searchqry .= "lower($value) like '%".strtolower($request->search)."%'";
            }else{
                $searchqry .= "OR lower($value) like '%".strtolower($request->search)."%'";
            }
        }
        $searchqry .= ")";
        if(@$request->sort_by){
            if(@$request->sort_by != null){
            	$explode = explode('.', $request->sort_by);
                 $query->orderBy($explode[0],$explode[1]);
            }else{
                  $query->orderBy('created_at','desc');
            }

             $query->whereRaw($searchqry);
        }else{
             $query->whereRaw($searchqry);
        }
        if($request->get == 'all'){
            return $query->get();
        }else{
                return $query->paginate($page);
        }

    }
}
