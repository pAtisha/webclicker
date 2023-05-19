<?php

namespace App\Exports;

use App\Models\Test;
use App\Models\Time;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

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
        $finished_tests = array();
        $users = array();
        $final_result = array();

        foreach ($this->tests_ids as $test_id)
        {
            $finished_test = Time::where('test_id', '=', $test_id)->get();
            $finished_tests[] = $finished_test;
        }

        foreach ($finished_tests as $finished_test)
        {
            foreach ($finished_test as $test)
            {
                $users[] = User::find($test->user_id);
            }
        }

        $users = array_unique($users);



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
