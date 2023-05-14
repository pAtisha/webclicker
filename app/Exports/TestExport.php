<?php

namespace App\Exports;

use App\Models\Test;
use App\Models\Time;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestExport implements FromCollection, WithHeadings
{
    private $test_id;

    public function __construct($test_id)
    {
        $this->test_id = $test_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $test = Test::find($this->test_id);
        $times = Time::where('test_id', '=', $this->test_id)->get();

        $result = array();

        foreach ($times as $time)
        {
            $user = User::find($time->user_id);
            $result[] = array(
                'name' => $user->name,
                'index_number' => $user->index_number,
                'points' => $time->points,
                'max_points' => $test->max_points,
            );
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            'Ime',
            'Broj indeksa',
            'Osvojeni poeni',
            'Maksimalni mogući poeni'
        ];
    }
}
