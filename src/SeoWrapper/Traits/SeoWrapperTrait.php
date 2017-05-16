<?php

namespace Flobbos\SeoWrapper\Traits;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Facades\Lang;

trait SeoWrapperTrait {
    
    public function setSeo($title, $slug, $meta_description = null){
        
        //Process title first
        $trans_str = 'seo.' . str_slug($title) . '.title';
        $title = Lang::has($trans_str) ? trans($trans_str) : $title;
        $this->seo()->setTitle($title);
        
        //Meta description
        if(!is_null($meta_description)){
            $this->seo()->setDescription($meta_description);
        }
        
        //Opengraph
        $url = request()->path() == '/' ? '/' : $slug;
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->opengraph()->setUrl( url($url) );

    }
    
}