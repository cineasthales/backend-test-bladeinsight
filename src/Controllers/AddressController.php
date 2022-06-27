<?php

namespace Turbines\Controllers;

use Turbines\Controllers\CrudableInterface;
use Turbines\Helpers\CsvFileTrait;

class AddressController implements CrudableInterface
{
    use CsvFileTrait;

    private $filePath = __DIR__ . '/../../storage/turbines';

    public function index() : array
    {
        return $this->readAllLines($this->filePath);
    }

    public function store(array $newData) : bool
    {
        if (!array_key_exists('address', $newData) || count($newData['address']) !== 4) {
            http_response_code(400);
            return false;
        }

        return $this->writeLine($this->filePath, $newData['address']);
    }

    public function show(string $id) : array
    {
        return $this->readOneLine($this->filePath, $id);
    }

    public function update(string $id, array $newData) : bool
    {
        if (!array_key_exists('address', $newData) || count($newData['address']) !== 3) {
            http_response_code(400);
            return false;
        }

        return $this->replaceLine($this->filePath, $id, $newData['address']);
    }

    public function destroy(string $id) : bool
    {
        return $this->deleteLine($this->filePath, $id);
    }
}