<?php

namespace App\Http\Livewire;

use App\Models\Cv;
use App\Models\User;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UsersDatatables extends LivewireDatatable {
	public $model = User::class;

	 public function builder() {
        return User::query()
        		->join("cvs", function($join) {
        			$join->on("users.id", "=", "cvs.cvable_id")->where('cvs.cvable_type', "=", 'App\Models\User'); 
        		});	
    }

	public function columns() {
		return [
			NumberColumn::name('id')
                ->label('ID')
                ->filterable(),
            Column::name("firstname")->label("Firstname"),
            Column::name("lastname")->label("Lastname"),
            Column::name("email")->label("Email"),
            Column::name("phone")->label("Phone"),
            Column::name("university")->label("University"),
            Column::name("study_year")->label("Year"),
            Column::name("study_field")->label("Field"),
            Column::name("motivation")->label("motivation"),
            Column::callback(['comptence'], function ($comptence) {
                return view('livewire.users-competences', ['comptence' => $comptence]);
            })->label("competence"),
            Column::name("linked_in")->label("linkedin"),
            DateColumn::name("birthday")->label("Birth date")->filterable(),
            DateColumn::name("created_at")->label("Regsitred at")->filterable(),
			Column::name('cvs.path')
				->label("CV")
				->linkTo("celec-site/storage/app"),
			Column::callback(['id', 'activated'], function ($id, $activated) {
                return view('livewire.users-accept', ['id' => $id, 'activated' => $activated]);
            })->label("Actions"),
            

		];
	}

	public function accept($id) {
		User::find($id)->update(["activated" => true]);
	}

    // public function render() {
    //     return view('livewire.users-datatables');
    // }
}
