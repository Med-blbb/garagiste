<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            // 'id' => $row[0],
            'name' => $row[1],
            'email' => $row[2],
            'role' => $row[3],
            'address' => $row[4],
            'phoneNumber' => $row[5],
            
        ]);
    }
}
