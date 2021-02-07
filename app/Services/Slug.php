<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;
use Illuminate\Support\Str;
/**
 * Description of Slug
 *
 * @author Admin
 */
class Slug {
    public function createSlug($modelName, $title, $slugFieldName, $primaryKeyFieldName, $primaryKeyFieldValue = 0) {
        // Normalize the title
        //echo $modelName;
        $slug = Str::slug($title, '-');
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $modelName, $slugFieldName, $primaryKeyFieldName, $primaryKeyFieldValue);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }
    protected function getRelatedSlugs($slug, $modelName, $slugFieldName, $primaryKeyFieldName, $primaryKeyFieldValue = 0) {
        $modelName = app("App\Models\\$modelName");
        return $modelName::select()->where($slugFieldName, 'like', $slug.'%')
            ->where($primaryKeyFieldName, '<>', $primaryKeyFieldValue)
            ->get();
    }
}
