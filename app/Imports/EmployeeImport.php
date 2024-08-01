<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmployeeImport implements ToModel, ShouldQueue, WithChunkReading, WithBatchInserts
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        if (isset($row[0]) && isset($row[1]) && isset($row[2]) && isset($row[3])) {
            $employee = Employee::where('email', $row[1])->first();
            if ($employee) {
                $employee->update([
                    'name' => $row[0],
                    'email' => $row[1],
                    'phone' => $row[2],
                    'password' => $row[3],
                ]);
            } else {
                Employee::create([
                    'name' => $row[0],
                    'email' => $row[1],
                    'phone' => $row[2],
                    'password' => $row[3],
                    'code' =>   uniqid('SSA-'),
                ]);
            }
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
