<?php
namespace App\Traits;

use App\Traits\CreateSlug;
/**
 *
 */
trait FormatCategories
{
    use CreateSlug;

    public function FormatCategories($categoriesJson)
    {
        $categoriesAdministrate = json_decode($categoriesJson,true);
        $categories = array();
        foreach ($categoriesAdministrate as &$category)
        {
            $subCategories = array();
            if (! empty($category['sub_categories']))
            {
                foreach ($category['sub_categories'] as &$subCategory)
                array_push($subCategories,array("id" => $subCategory['id'],"title" => $subCategory['title'], "slug" => $this -> CreateSlug($subCategory['title'])));
            }
            if (empty($subCategories)) {
                array_push($categories,array("id"=>$category['id'],"title"=>$category['name'], "slug" =>  $this -> CreateSlug($category['name'])));
            }
            else {
                array_push($categories,array("id"=>$category['id'],"title"=>$category['name'], "slug" =>  $this -> CreateSlug($category['name']),"categories"=>$subCategories));
            }
        }
        $theReturn['categories']=$categories;
        return json_encode($theReturn);
    }
}
