<?php

namespace App\Exports\Sheets;

use App\Room;
use Maatwebsite\Excel\Concerns\FromCollection;

class RoomExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Room::select('id', 'price', 'photo', 'description', 'roomtype_id', 'township_id', 'capacity', 'size', 'deleted_at')->with(['services:id,name', 'roomtype:id,name', 'township:id,name'])->orderBy('id', 'desc')->get();
    }
}
