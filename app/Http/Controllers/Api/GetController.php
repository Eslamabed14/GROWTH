<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GraphicResource;
use App\Http\Resources\InfoResource;
use App\Http\Resources\MotionResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\TeamResource;
use App\Models\App;
use App\Models\AppCat;
use App\Models\Article;
use App\Models\Category;
use App\Models\Graphic;
use App\Models\GraphicCat;
use App\Models\Info;
use App\Models\Motion;
use App\Models\MotionCat;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function team()
    {
        $teams = Team::all();
        if (count($teams) > 0) {
            return response()->json([
                'success' => true,
                'team' => TeamResource::collection($teams)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'team' => []
            ], 200);
        }
    }

    public function info()
    {
        $info = Info::find(1);
        if ($info) {
            return response()->json([
                'success' => true,
                'info' => new InfoResource($info)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'info' => []
            ], 200);
        }
    }

    public function services()
    {
        $services = Service::all();
        if (count($services) > 0) {
            return response()->json([
                'success' => true,
                'services' => ServiceResource::collection($services)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'services' => []
            ], 200);
        }
    }

    public function partners()
    {
        $partners = Partner::all();
        if (count($partners) > 0) {
            return response()->json([
                'success' => true,
                'partners' => PartnerResource::collection($partners)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'partners' => []
            ], 200);
        }
    }

    public function articles()
    {
        $articles = Article::paginate(6);
        if (count($articles) > 0) {
            return  ArticleResource::collection($articles);
        } else {
            return response()->json([
                'success' => false,
                'articles' => []
            ], 200);
        }
    }

    public function article($id)
    {
        $article = Article::find($id);
        if ($article) {
            return response()->json([
                'success' => true,
                'article' => new ArticleResource($article)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'article' => []
            ], 200);
        }
    }

    public function apps()
    {
        $apps = App::all();
        $cats = AppCat::all();
        if (count($apps) > 0) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'apps' => AppResource::collection($apps),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'apps' => []
            ], 200);
        }
    }

    public function app($id)
    {
        $app = App::find($id);
        if ($app) {
            return response()->json([
                'success' => true,
                'app' => new AppResource($app)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no such app'
            ], 200);
        }
    }

    public function products()
    {
        $cats = Category::all();
        $products = Product::all();
        if (count($cats) > 0 && count($products)) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'products' => ProductResource::collection($products),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'there is no cats or products'
            ], 200);
        }
    }

    public function product($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'success' => true,
                'product' => new ProductResource($product)
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'product' => []
            ], 200);
        }
    }

    public function motions()
    {
        $motions = Motion::all();
        $cats = MotionCat::all();
        if (count($motions) > 0) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'motions' => MotionResource::collection($motions),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'motions' => []
            ], 200);
        }
    }

    public function graphics()
    {
        $graphics = Graphic::all();
        $cats = GraphicCat::all();
        if (count($graphics) > 0) {
            return response()->json([
                'success' => true,
                'cats' => CategoryResource::collection($cats),
                'graphics' => GraphicResource::collection($graphics),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'graphics' => []
            ], 200);
        }
    }
}
