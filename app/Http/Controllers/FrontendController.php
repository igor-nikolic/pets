<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Menu;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    //
    private $data;
    private $menu;
    private $company;

    public function __construct()
    {
        $menu = new Menu();
        $company = new Company();
        $this->data['menu'] = $menu->getAll();
        $this->data['company'] = $company->getFirst();
    }

    public function home(){
        return view('pages.front.home',$this->data);
    }
    public function about(){
        return view('pages.front.about',$this->data);
    }

    public function userPanel(){
        return view('pages.front.user_panel',$this->data);
    }
}
