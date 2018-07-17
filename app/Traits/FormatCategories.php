<?php
namespace App\Traits;
/**
 *
 */
trait FormatCategories
{

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
                array_push($subCategories,array("id" => $subCategory['id'],"title" => $subCategory['title'], "slug" => str_slug($subCategory['title'],'-')));
            }
            if (empty($subCategories)) {
                array_push($categories,array("id"=>$category['id'],"title"=>$category['name'], "slug" =>  str_slug($category['name'],'-')));
            }
            else {
                array_push($categories,array("id"=>$category['id'],"title"=>$category['name'], "slug" =>  str_slug($category['name'],'-'),"categories"=>$subCategories));
            }
        }
        ;
        return json_encode($categories);
    }
}
