<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Category;
use app\models\Tag;
use app\models\Product;
use app\models\ProductTag;
use app\models\Checklist;
use app\models\ChecklistProduct;

class SiteController extends BaseController {

    public function actionIndex() {
        return 'Basic Web Services';
    }

    public function actionData() {
        $generator = new \Nubs\RandomNameGenerator\Alliteration();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->username = $generator->getName();
            $user->email = strtolower(substr($user->username, 0, 4)) . '@gmail.com';
            $user->password = sha1('123123');
            $user->img = 'face' . ($i + 1) . '.jpg';
            $user->hash = md5($user->email);
            $user->status = 1;
            $user->save();

            $cIDS = [];
            for ($j = 0; $j < 15; $j++) {
                $category = new Category();
                $category->user_id = $user->user_id;
                $category->description = $generator->getName();
                $category->status = 1;
                $category->save();
                $cIDS[$j] = $category->category_id;
            }

            $tIDS = [];
            for ($x = 0; $x < 12; $x++) {
                $tag = new Tag();
                $tag->user_id = $user->user_id;
                $tag->description = '#' . substr(strtolower($generator->getName()), 0, 6);
                $tag->status = 1;
                $tag->save();
                $tIDS[$x] = $tag->tag_id;
            }

            for ($k = 0; $k < 50; $k++) {
                $product = new Product();
                $product->category_id = rand($cIDS[0], $cIDS[count($cIDS) - 1]);
                $product->description = $generator->getName();
                $product->price = rand(80, 200);
                $product->quantity = rand(300, 500);
                $product->img = ($k + 1) . '.png';
                $product->status = 1;
                $product->save();
                $pIDS[$k] = $product->product_id;

                for ($y = 0; $y < 3; $y++) {
                    $productTag = new ProductTag();
                    $productTag->product_id = $product->product_id;
                    $productTag->tag_id = rand($tIDS[0], $tIDS[count($tIDS) - 1]);
                    $productTag->save();
                }
            }

            for ($p = 0; $p < 15; $p++) {
                $checklist = new Checklist();
                $checklist->user_id = $user->user_id;
                $checklist->description = $generator->getName();
                $checklist->status = 1;
                $checklist->save();

                for($m = 0; $m < 4; $m++) {
                  $checklistProduct = new ChecklistProduct();
                  $checklistProduct->checklist_id = $checklist->checklist_id;
                  $checklistProduct->product_id = rand($pIDS[0], $pIDS[count($pIDS) - 1]);
                  $checklistProduct->save();
                }
            }

        }
    }

}
