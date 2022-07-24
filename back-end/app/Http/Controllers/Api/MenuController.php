<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;


class MenuController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $Menu = Menu::get();

        //return collection of posts as a resource
        return new MenuResource(true, 'List Data Menu', $Menu);
    }
        
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Menu $menu)
    {
        //return single post as a resource
        return new MenuResource(true, 'Data Menu Ditemukan!', $menu);
    }
    
    public function showtype(Request $request)
    {
        $kategori = $request->tipe_produk;
        $result = Menu::where('tipe_produk', $kategori)->get();
        //return single post as a resource
        return new MenuResource(true, 'Data Menu Ditemukan!', $result);
    }
}