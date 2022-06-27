<?php

namespace Turbines\Helpers;

trait CsvFileTrait
{
    public function readAllLines(string $filePath) : array
    {
        $lines = [];

        $file = fopen($filePath . '.csv', 'r');
        if (!$file) {
            http_response_code(404);
            exit();
        }

        while (($data = fgetcsv($file)) !== false) {
            $lines[] = $data;
        }

        fclose($file);

        return $lines;
    }

    public function writeLine(string $filePath, array $newData) : bool
    {
        $file = fopen($filePath . '.csv', 'a');

        $saved = fputcsv($file, $newData);

        fclose($file);

        return $saved !== false;
    }

    public function readOneLine(string $filePath, string $id) : array
    {
        $line = [];

        $file = fopen($filePath . '.csv', 'r');
        if (!$file) {
            http_response_code(404);
            exit();
        }

        while (($data = fgetcsv($file)) !== false) {
            if ($data[0] === $id) {
                $line = $data;
                break;
            }
        }

        fclose($file);

        return $line;
    }

    public function replaceLine(string $filePath, string $id, array $newData) : bool
    {
        $file = fopen($filePath . '.csv', 'r');
        if (!$file) {
            http_response_code(404);
            exit();
        }

        $fileTemp = fopen($filePath . '_temp.csv', 'w');

        array_unshift($newData, $id);

        $foundLine = false;

        while (($data = fgetcsv($file)) !== false) {
            if ($data[0] !== $id) {
                fputcsv($fileTemp, $data);
            } else {
                fputcsv($fileTemp, $newData);
                $foundLine = true;
            }
        }

        fclose($file);
        fclose($fileTemp);

        $this->renameOrUnlink($foundLine, $filePath);

        return $foundLine;
    }

    public function deleteLine(string $filePath, string $id) : bool
    {
        $file = fopen($filePath . '.csv', 'r');
        if (!$file) {
            http_response_code(404);
            exit();
        }

        $fileTemp = fopen($filePath . '_temp.csv', 'w');

        $foundLine = false;

        while (($data = fgetcsv($file)) !== false) {
            if ($data[0] !== $id) {
                fputcsv($fileTemp, $data);
            } else {
                $foundLine = true;
            }
        }

        fclose($file);
        fclose($fileTemp);

        $this->renameOrUnlink($foundLine, $filePath);

        return $foundLine;
    }

    private function renameOrUnlink(bool $foundLine, string $filePath) : void
    {
        if ($foundLine) {
            rename($filePath . '_temp.csv', $filePath . '.csv');
        } else {
            unlink($filePath . '_temp.csv');
        }
    }
}