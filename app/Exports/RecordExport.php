<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RecordExport implements FromCollection, WithHeadings, WithMapping
{
    protected $records;

    // Accept the $records collection in the constructor
    public function __construct($records)
    {
        $this->records = $records;
    }

    // Return the passed records collection
    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
             'Semester', 'Batch', 'Program', 'Applied on', 'Name', 'Email',
            'CNIC', 'Nationality', 'Gender', 'Date of Birth', 'Place of Birth',
            'Domicile District', 'Domicile Province', 'Religion', 'Cell no',
            'Hafiz e Quran', 'Disabled Candidate', 'Father\'s Name',
            'Guardian\'s Name (If any)', 'Guardian\'s Relation', 'Father/Guardian CNIC',
            'Father/Guardian Income', 'Address Line', 'City', 'State/Province',
            'Country', 'Contact', 'Matric Degree', 'Matric Board', 'Matric Institute',
            'Matric Passing Year', 'Matric Exam', 'Matric Roll No', 'Matric Total Marks',
            'Matric Obtained Marks', 'Matric Percentage', 'Matric Grade',
            'Inter Degree', 'Inter Board', 'Inter Institute', 'Inter Passing Year',
            'Inter Exam', 'Inter Roll No', 'Inter Total Marks', 'Inter Obtained Marks',
            'Inter Percentage', 'Inter Grade', 'BA/BSC Degree', 'BA/BSC Board',
            'BA/BSC Institute', 'BA/BSC Passing Year', 'BA/BSC Exam', 'BA/BSC Roll No',
            'BA/BSC Total Marks', 'BA/BSC Obtained Marks', 'BA/BSC Percentage',
            'BA/BSC Grade', 'MA/MSc/BS Degree', 'MA/MSc/BS Board', 'MA/MSc/BS Institute',
            'MA/MSc/BS Passing Year', 'MA/MSc/BS Exam', 'MA/MSc/BS Roll No',
            'MA/MSc/BS Total Marks', 'MA/MSc/BS Obtained Marks', 'MA/MSc/BS Percentage',
            'MA/MSc/BS Grade', 'Challan No', 'Challan Fee', 'Challan Status'
        ];
    }

    public function map($record): array
    {
        $user = $record->user;
        $personalInfo = $user->personalinfo ?? null;
        $fatherInfo = $user->fatherinfo ?? null;
        $address = $user->address ?? null;
        $education = [
            'matriceducation', 'intereducation', 'baeducation', 'bseducation'
        ];

        $row = [
            $record->admission->semester,
            $record->admission->batch,
            $record->program->name,
            $record->created_at->format('d-M-Y , H:i'),
            $user->name,
            $user->email,
            $personalInfo->cnic ?? '',
            $personalInfo->nationality ?? '',
            $personalInfo->gender ?? '',
            $personalInfo->dob ?? '',
            $personalInfo->pob ?? '',
            $personalInfo->domicileDist ?? '',
            $personalInfo->domicileProvince ?? '',
            $personalInfo->religion ?? '',
            $personalInfo->contact ?? '',
            $personalInfo->hafiz ?? '',
            $personalInfo->disabled ?? '',
            $fatherInfo->fname ?? '',
            $fatherInfo->gname ?? '',
            $fatherInfo->grelation ?? '',
            $fatherInfo->fcnic ?? '',
            $fatherInfo->income ?? '',
            $address->line ?? '',
            $address->city ?? '',
            $address->province ?? '',
            $address->country ?? '',
            $address->contact ?? '',
        ];

        foreach ($education as $edu) {
            $prefix = $edu === 'matriceducation' ? 'm' : ($edu === 'intereducation' ? 'i' : ($edu === 'baeducation' ? 'ba' : 'bs'));
            $row[] = $user->$edu->degree->name ?? '';
            $row[] = $user->$edu->{$prefix.'board'} ?? '';
            $row[] = $user->$edu->{$prefix.'institute'} ?? '';
            $row[] = $user->$edu->{$prefix.'year'} ?? '';
            $row[] = $user->$edu->{$prefix.'exam'} ?? '';
            $row[] = $user->$edu->{$prefix.'roll'} ?? '';
            $row[] = $user->$edu->{$prefix.'total'} ?? '';
            $row[] = $user->$edu->{$prefix.'obtained'} ?? '';
            $row[] = $user->$edu->{$prefix.'percent'} ?? '';
            $row[] = $user->$edu->{$prefix.'grade'} ?? '';
        }

        if ($record->challan) {
            $row[] = $record->challan->challan_no;
            $row[] = $record->challan->fee;
            $row[] = $record->challan->status;
        }

        return $row;
    }
}
