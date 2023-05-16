<?php

namespace App\Exports;

use App\Models\Test;
use App\Models\Time;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestsExport implements FromCollection, WithHeadings
{
    private $course_id;

    public function __construct($course_id = 0)
    {
        $this->course_id = $course_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $tests = Test::where('course_id', '=', $this->course_id)->get();

        $result = array();

        foreach ($tests as $test)
        {
            $times = Time::where('test_id', '=', $test->id)->get();

            foreach ($times as $time)
            {
                $user = User::find($time->user_id);
                $result[] = array(
                    'name' => $user->name,
                    'index_number' => $user->index_number,
                    'test' => $test->name,
                    'points' => $time->points,
                    'max_points' => $test->max_points,
                );
            }
        }

        return collect($result);
    }

    public function headings() : array
    {
        return [
            'Ime',
            'Broj indeksa',
            'Ime testa',
            'Osvojeni poeni',
            'Maksimalni mogući poeni'
        ];
    }
}
