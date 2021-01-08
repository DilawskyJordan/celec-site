<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component {

	use WithFileUploads;

	public $firstname;
	public $lastname;
	public $birthday;
	public $email;
	public $phone;
	public $university;
	public $study_year;
	public $study_field;
	public $motivation;
	public $comptence = [];
	public $knowing_the_club;
	public $linked_in;
	public $other;
	public $cv;

    public function rules() {
    	return [
			"firstname" => "required|min:3|max:200",
			"lastname" => "required|min:3|max:200",
			"email" => "required|email:rfc|unique:users,email",
			"birthday" => "required|date",
			"phone" => "required|max:10|unique:users,phone",
			"university" => "required|max:100",
			"study_year" => ['required', Rule::in(['L1', 'L2', 'L3', 'M1', 'M2'])],
			"study_field" => "required",
			"motivation" => "required",
			"comptence.*" => "required",
			"knowing_the_club" => "required",
			"linked_in" => "url",
			"cv" => "required|mimes:pdf,doc|max:500"
    	];
    }

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function render() {
        return view('livewire.register');
    }

    public function submit() {
    	$this->validate();
    	$birthday 	=	Carbon::parse($this->birthday);
    	$now 		= 	Carbon::now();
    	if($birthday->greaterThan($now)) {
    		return  $this->dispatchBrowserEvent('birthday-error', ['message' => "nous n'acceptons pas les dates de naissance dans le futur -_-"]);
    	}
    	$this->comptence["other"] = $this->other;

    	$user = User::create([
    		"firstname" 		=> 		$this->firstname,
	        'lastname' 			=> 		$this->lastname,
	        'email' 			=> 		$this->email,
	        "birthday" 			=> 		$birthday->toDateTimeString(),
	        "phone" 			=> 		$this->phone,
	        "university" 		=> 		$this->university,
	        "study_year" 		=> 		$this->study_year,
	        "study_field" 		=> 		$this->study_field,
	        "motivation" 		=> 		$this->motivation,
	        "comptence" 		=> 		$this->comptence,
	        "knowing_the_club" 	=> 		$this->knowing_the_club,
	        'linked_in' 		=> 		$this->linked_in,
	        "activated"			=>		false,
    	]);	
    	$cvPath = $this->cv->store("cvs");
    	$user->cv()->create(["path" => $cvPath]);
    	return  $this->dispatchBrowserEvent('user-created', ['message' => "Vous êtes inscrit avec succès, veuillez confirmer votre inscription au club!"]);
    }
}