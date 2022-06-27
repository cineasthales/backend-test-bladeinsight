<?php

namespace Turbines\Controllers;

interface CrudableInterface {

    public function index() : array;
    public function store(array $newData) : bool;
    public function show(string $id) : array;
    public function update(string $id, array $newData) : bool;
    public function destroy(string $id) : bool;

}