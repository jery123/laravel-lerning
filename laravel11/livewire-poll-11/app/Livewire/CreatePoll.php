<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreatePoll extends Component
{

    #[Validate('required', message: 'Please enter a title.')]
    #[Validate('min:3', message: 'Your title is too short (Min 3 characters required).')]
    public $title;

    #[Validate([
        'options' => 'required|min:1|max:10',
        'options.*' => 'required|min:2|max:255',
    ], message: [
        'required' => 'The :attribute is missing.',
        'options.required' => 'The :attribute are missing.',
        'min' => 'The :attribute is too short.',
    ], attribute: [
        'options.*' => 'option',
    ])]
    public $options = ['First'];

    protected $rules = [
        'title' => "required|min:3|max:255",
        'options' => "required|min:1|max:10",
        'options.*' => "required|min:2|max:255"
    ];

    protected $messages = [
        'options.*' => "The option can't be empty"
    ];

    public function addOption(){
        $this->options[] = '';
    }

    public function removeOption($index){
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function createPoll(){

        $this->validate();
        // $poll =
        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
            collect($this->options)
                ->map(fn($option) => ['name' => $option])
                ->all()
        );

        // foreach($this->options as $optionName){
        //     $poll->options()->create(['name' => $optionName]);
        // }

        $this->reset(['title', 'options']);
        $this->dispatch('poll-created'); 
    }

    public function render()
    {
        return view('livewire.create-poll');
    }
}
