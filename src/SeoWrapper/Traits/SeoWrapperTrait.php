<?php

namespace Flobbos\SeoWrapper\Traits;

use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Facades\Lang;

trait SeoWrapperTrait {
    
    use SEOToolsTrait;
    
    public function setSeo($title, $slug, $meta_description = null){
        
        //Work on the title first
        $trans_str = 'seo.' . str_slug($title) . '.title';
        $title = Lang::has($trans_str) ? trans($trans_str) : $title;
        $this->seo()->setTitle($title);
        
        //Check meta description
        if(!is_null($meta_description)){
            $this->seo()->setDescription($meta_description);
        }
        //Opengraph 
        $this->seo()->opengraph()->addProperty('type', 'page');
        //Check request path
        $url = request()->path() == '/' ? '/' : $slug;
        $this->seo()->opengraph()->setUrl(url($url) );
        //Canonical
        $this->seo()->setCanonical(request()->url());
        
    }
    
}
