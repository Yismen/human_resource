<?php

namespace Dainsys\HumanResource\Http\Livewire\Bank;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\HumanResource\Models\Bank;
use Dainsys\HumanResource\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createBank',
        'updateBank',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showBankFormModal';

    public $bank;

    protected function getRules()
    {
        return [
            'bank.name' => [
                'required',
                Rule::unique(tableName('banks'), 'name')->ignore($this->bank->id ?? 0)
            ],
            'bank.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('human_resource::livewire.bank.form', [
        ])
        ->layout('human_resource::layouts.app');
    }

    public function createBank()
    {
        $this->bank = new Bank();
        $this->authorize('create', $this->bank);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateBank(Bank $bank)
    {
        $this->bank = $bank;
        $this->authorize('update', $this->bank);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Bank());
        $this->validate();

        $this->editing = false;

        $this->bank->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('bankUpdated');

        flashMessage('Bank created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->bank);
        $this->validate();

        $this->bank->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Bank Updated!', 'warning');

        $this->editing = false;

        $this->emit('bankUpdated');
    }
}
