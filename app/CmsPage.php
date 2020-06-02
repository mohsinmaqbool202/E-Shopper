<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    protected $table = 'cms_pages';
    protected $fillable = ['under', 'title', 'description', 'url','meta_title','meta_description','meta_keywords', 'status'];
}
