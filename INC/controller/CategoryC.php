<?php
require_once __DIR__ . '/../config/Config.php';
require_once __DIR__ . '/../model/Category.php';
$db = Config::getDB();
function deleteCategory($id)
{
    global $db;
    return Category::delete($db, $id);
}
function getCategoryByid($id)
{
    global $db;
    return Category::getbyid($db, $id);
}
function editCategory($name, $id = null)
{
    global $db;
    $c = new Category($name);
    return $c->save($db, $id);
}
function getAllCategoriesCrud()
{
    global $db;
    $categories = Category::getAll($db);
    $result = "";
    foreach ($categories as $category) {
        $result .= "<tr>
        <td>$category->name</td>
        
        <td>
        <div class='d-flex justify-content-center'>
            <a href='./INC/controller/DeleteCategoryC.php?id=$category->id' class='delete' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>
        </div>
        </td>
    </tr>";
    }
    return $result;
}
function getAllCategoriesSelect($category)
{
    global $db;
    $categories = Category::getAll($db);
    $result = "";
    foreach ($categories as $categoory) {
        $result .= "<option value=$categoory->id";
        if ($categoory->id == $category) {
            $result .= " selected='selected'";
        }
        $result .= ">$categoory->name</option>";
    }
    return $result;
}
function getAllCategories()
{
    global $db;
    $categories = Category::getAll($db);
    if (count($categories) > 1) {
        list($array1, $array2) = array_chunk($categories, ceil(count($categories) / 2));
    } else {
        $array1 = $categories;
    }
    $result = "
    <div class='card mb-4 border border-dark border-2'>
          <div class='card-header  text-bg-dark'>Categories</div>
          <div class='card-body'>
            <div class='row'>
              <div class='col-sm-6'>
              ";
    foreach ($array1 as $value) {
        $result .= "<li><a id='$value->id' href='#$value->id' onClick='searchID(this.id);'>$value->name</a></li>";
    }
    $result .= "
              </div>
              <div class='col-sm-6'>";
    if (count($categories) > 1) {
        foreach ($array2 as $value) {
            $result .= "<li><a id='$value->id' href='#$value->id' onClick='searchID(this.id);'>$value->name</a></li>";
        }
    }
    $result .= "
                </div>
                </div>
            </div>
            </div>";
    return $result;
}
