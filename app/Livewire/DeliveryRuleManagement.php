<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DeliveryRule;
use App\Models\Restaurant;

class DeliveryRuleManagement extends Component
{
    public $restaurantId;
    public $rules;
    
    public $type = 'fixed';
    public $min_items;
    public $min_purchase;
    public $discount_percentage;
    public $fixed_fee;
    
    public $showForm = false;
    public $editingRuleId = null;

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;
        $this->loadRules();
    }

    public function loadRules()
    {
        $this->rules = DeliveryRule::where('restaurant_id', $this->restaurantId)->get();
    }

    public function createRule()
    {
        $this->reset(['editingRuleId', 'type', 'min_items', 'min_purchase', 'discount_percentage', 'fixed_fee']);
        $this->showForm = true;
    }

    public function editRule($id)
    {
        $rule = DeliveryRule::findOrFail($id);
        $this->editingRuleId = $rule->id;
        $this->type = $rule->type;
        $this->min_items = $rule->min_items;
        $this->min_purchase = $rule->min_purchase;
        $this->discount_percentage = $rule->discount_percentage;
        $this->fixed_fee = $rule->fixed_fee;
        $this->showForm = true;
    }

    public function saveRule()
    {
        $data = $this->validate([
            'type' => 'required|in:fixed,free_items,discount_items,free_purchase',
            'min_items' => 'nullable|integer|min:1',
            'min_purchase' => 'nullable|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'fixed_fee' => 'nullable|numeric|min:0',
        ]);

        if ($this->editingRuleId) {
            DeliveryRule::find($this->editingRuleId)->update($data);
        } else {
            DeliveryRule::create(array_merge($data, ['restaurant_id' => $this->restaurantId]));
        }

        $this->showForm = false;
        $this->loadRules();
        $this->dispatch('notify', ['message' => 'Delivery rule saved!']);
    }

    public function deleteRule($id)
    {
        DeliveryRule::destroy($id);
        $this->loadRules();
    }

    public function toggleRule($id)
    {
        $rule = DeliveryRule::find($id);
        $rule->is_active = !$rule->is_active;
        $rule->save();
        $this->loadRules();
    }

    public function render()
    {
        return view('livewire.delivery-rule-management');
    }
}
