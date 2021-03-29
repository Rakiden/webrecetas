<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Recipe;

class RecipeController extends Controller
{
    //
    public function getIndex(Request $request){
        
        if(request()->has('category')){
            $recipes = Recipe::where('category',request('category'))->orderBy('id','desc')->paginate(9)->appends('category', request('category'));
        }elseif(request()->has('search')){
            $recipes = Recipe::where('title', 'like', '%'.request('search').'%')->orderBy('id','desc')->paginate(9)->appends('title', request('search'));
        }else{
            $recipes = Recipe::orderBy('id','desc')->paginate(9);
        }
        
        return view('index',['recipes'=> $recipes]);
    }

    public function getRecipe($id){
        $recipe = Recipe::find($id);
        $comments = DB::table('comment')->where('recipe_id',$id)->orderBy('id','desc')->paginate(20);
        $userId = Auth::id();
        $favourites = DB::table('favourite')->where('recipe_id',$id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        
        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments, 'isFavourite'=>$isFavourite]);
    }

    public function getPanel(Request $request){

        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();

        if(request()->has('category')){
            $myRecipes = DB::table('recipe')->where('user_id',$userId)->where('category',request('category'))->orderBy('id','desc')->paginate(11)->appends('category', request('category'));
        }elseif(request()->has('search')){
            $myRecipes = DB::table('recipe')->where('title', 'like', '%'.request('search').'%')->orderBy('id','desc')->paginate(12)->appends('title', request('search'));
        }else{
            $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->paginate(11);
        }

        return view('userPanel/panel', ['user' => $user, 'myRecipes'=>$myRecipes]);
    }

    public function getUserRecipe($id){
        $recipe = Recipe::find($id);
        return view('userPanel/userRecipes', ['recipe'=>$recipe]);
    }

    public function getcreateRecipe(){ 
        $categories = DB::table('category')->orderBy('id','asc')->get();
        return view('recipes/createRecipe',['categories'=>$categories,'mode'=>1]);
    }

    public function createRecipe(Request $request){ 
        
        DB::table('recipe')->insert([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'ingredients' => $request->input('ingredients'),
                'category_id' => $request->input('category'),
                'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($request->file('image')->path())),
                ]);

        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();

        return redirect('panel');
    }

    public function getupdateRecipe($recipe_id){ 
        $recipe = Recipe::find($recipe_id);
        $category_id=$recipe->get()[0]->category_id;
        $categories = DB::table('category')->orderBy('id','asc')->get();
        return view('recipes/createRecipe',['mode'=>2, 'recipe' => $recipe, 'category_id'=>$category_id,'categories'=>$categories]);
    }

    public function updateRecipe(Request $request,$recipe_id){ 
        DB::table('recipe')->where('id',$recipe_id)->update([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'ingredients' => $request->input('ingredients'),
                'category' => $request->input('category'),
                'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($request->file('image')->path())),
                ]);

        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();

        return redirect('panel');
    }    

    public function deleteRecipe(Request $request,$recipe_id){ 
        DB::table('comment')->where('recipe_id', $recipe_id)->delete();
        $recipe = DB::table('recipe')->where('id', $recipe_id)->delete();
        
        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();

        return redirect('panel');
    }  

    public function insertComment(Request $request,$recipe_id){ 
        $userId = Auth::id();
        DB::table('comment')->insert([
            'user_id' => $userId,
            'recipe_id' => $recipe_id,
            'text' => $request->input('comment'),
        ]);

        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);

        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments]);
    }

    public function getCategories(){ 
        $categories = DB::table('category');

        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments]);
    }

    
    public function setRecipeFavourite($recipe_id){ 
       
       $userId = Auth::id();
        DB::table('favourite')->insert([
            'user_id' => $userId,
            'recipe_id' => $recipe_id
        ]);

        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);
        $favourites = DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments, 'isFavourite'=>$isFavourite]);
    }
    public function unsetRecipeFavourite($recipe_id){ 
    
        $userId = Auth::id();
        DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->delete();

        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);
        $favourites = DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments, 'isFavourite'=>$isFavourite]);
    }
}
