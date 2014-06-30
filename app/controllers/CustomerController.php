<?php

class CustomerController extends BaseController {
	public function getIndex() {

		$id = Input::get("id");
		return Customer::find($id);

	}

	public function getAll() {
	    return Customer::all();
	}

}