<?php

namespace Turbines\Controllers;

use Turbines\Helpers\CsvFileTrait;

class AddressController
{
    use CsvFileTrait;

    private $filePath = __DIR__ . '/../../storage/turbines';

    public function index() : array
    {
        return $this->readAllLines($this->filePath);
    }

    public function store(array $newData) : bool
    {
        return $this->writeLine($this->filePath, $newData['address']);
    }

    public function show(string $id) : array
    {
        return $this->readOneLine($this->filePath, $id);
    }

    public function update(string $id, array $newData) : bool
    {
        return $this->replaceLine($this->filePath, $id, $newData['address']);
    }

    public function destroy(string $id) : bool
    {
        return $this->deleteLine($this->filePath, $id);
    }
}