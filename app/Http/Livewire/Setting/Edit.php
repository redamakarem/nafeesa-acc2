<?php

namespace App\Http\Livewire\Setting;

use App\Models\Setting;
use Livewire\Component;

class Edit extends Component
{
    public Setting $setting;

    public array $listsForFields = [];

    public function mount(Setting $setting)
    {
        $this->setting = $setting;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.setting.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->setting->save();

        return redirect()->route('admin.settings.index');
    }

    protected function rules(): array
    {
        return [
            'setting.key' => [
                'string',
                'required',
            ],
            'setting.value' => [
                'string',
                'required',
            ],
            'setting.type' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['type'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['type'] = $this->setting::TYPE_SELECT;
    }
}
