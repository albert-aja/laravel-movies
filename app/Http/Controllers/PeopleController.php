<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\General;
use App\ViewModels\PeopleViewModel;
use App\ViewModels\PersonViewModel;

class PeopleController extends Controller
{
    public function index(Request $request){
        $page = $request->query('page') ?? 1;
        abort_if($page > 500, 204);

        $people = General::callAPI('/person/popular?page='.$page)['results'];
        
        $viewModel = new PeopleViewModel(
            $people,
            $page,
        );

        return view('people.index', $viewModel);
    }
    
    public function show($id){
        $detail = General::callAPI('/person/'.$id.'?append_to_response=combined_credits,images,external_ids');

        $viewModel = new PersonViewModel(
            $detail
        );

        return view('people.show', $viewModel);
    }
}
