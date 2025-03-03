<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\StoreClientRequest;
use Tests\TestCase;

class StoreClientRequestTest extends TestCase
{
    public function testItFailsValidationWhenNoContactProvided()
    {
        $request = new StoreClientRequest([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => null,
            'phone' => null,
            '_token' => csrf_token(),
        ]);

        $validator = validator($request->all(), $request->rules());
        $request->withValidator($validator);

        $this->assertTrue($validator->fails());
        $this->assertEquals(__('clients.contact_required'), $validator->errors()->first('contact'));
    }
}