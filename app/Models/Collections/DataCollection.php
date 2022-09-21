<?php

namespace App\Models\Collections;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Data collection base class
 */
class DataCollection extends Collection
{
    /** Data collection rules */
    protected $rules;

    /**
     * DataCollection Constructor
     * @param $rules array
     * @param $items array
     */
    public function __construct(array $rules = [], array $items = [])
    {
        $this->rules = $rules;
        $this->validateData($items);
        Parent::__construct($items);
    }

    /**
     * Validates data before storing to collection
     * @param $items array
     * @throws ValidationException
     */
    private function validateData(array $items)
    {
        $validator = Validator::make($items, $this->rules);
 
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            throw ValidationException::withMessages([$error]);
        }
    }

    /**
     * Get the items with the specified keys.
     *
     * @param  \Illuminate\Support\Enumerable<array-key, TKey>|array<array-key, TKey>|string  $keys
     */
    public function only($keys)
    {
        return Arr::only($this->items, $keys);
    }
}
