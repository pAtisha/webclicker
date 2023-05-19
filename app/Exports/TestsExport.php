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
    private $tests_ids;
    private $tests_count;

    public function __construct($course_id = 0, $tests_ids = 0)
    {
        $this->course_id = $course_id;
        $this->tests_ids = $tests_ids;
        $this->tests_count = count($tests_ids);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $times = array();
        $users = array();
        $res = array();

        foreach ($this->tests_ids as $test_id)
        {
            $time = Time::where('test_id', '=', $test_id)->get();
            $times[] = $time;
        }
        foreach ($times as $time)
        {
            foreach ($time as $one_time)
            {
                $user = User::find($one_time->user_id);
                $users[] = $user;
                $res[] = $one_time;
            }
        }
        $users = array_unique($users);
        $res = array_unique($res);

        foreach ($users as $index => $user)
        {
            $result[$index]['name'] = $user->name;
            $result[$index]['index_number'] = $user->index_number;

            foreach ($res as $index_time => $one_time) {
                if ($one_time->user_id == $user->id) {
                    $test = Test::find($one_time->test_id);
                    $result[$index]['test' . $index_time] = $test->name;
                    $result[$index]['points' . $index_time] = $one_time->points;
                    $result[$index]['max_points' . $index_time] = $test->max_points;
                }
            }
        }
        return collect($result);
    }

    public function headings() : array
    {
        $string_array[] = array();
        $string_array = [
            'Ime',
            'Broj indeksa',
        ];

        for ($i = 0;$i < $this->tests_count; $i++)
        {
            $string_array[] = 'Ime testa';
            $string_array[] = 'Broj osvojenih poena';
            $string_array[] = 'Broj maksimalno mogućih poena';
        }
        return $string_array;
    }
}
