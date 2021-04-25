<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'studentId'=>$this->id,
            'studentName'=>$this->student_name,
            'fatherName' => $this->father_name,
            'motherName' => $this->mother_name,
            'guardianName' => $this->guardian_name,
            'relationTogGurdian' => $this->relation_to_gurdiane,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'address' => $this->address,
            'city' => $this->city,
            'district' => $this->district,
            'stateId' => $this->state_id,
            'pin' => $this->pin,
            'gurdianContactNumber' => $this->gurdian_contact_number,
            'whatsappNumber' => $this->whatsapp_number,
            'email' => $this->email_id,
            'qualification' => $this->qualification
        ];
    }
    /*
        "studentId":6,
	"episodeId":"a6",
	"studentName": "Saikat Kundu",
	"fatherName": "Abinash Kundu",
	"motherName": "Sulekha Kundu",
	"guardianName": "Abinash Kundu",
	"relationTogGurdian" : "father",
	"dob" : "2000-03-25",
	"sex" : "M",
	"address": "15/b M.G Road",
	"city": "kolkata",
	"ditrict":"kolkata",
	"stateId":1,
	"pin": "70014",
	"gurdianContactNumber":"798524103",
	"whatsappNumber" : "70033105284",
	"email": "saikata234@gmail.com",
	"qualification" : "HS"
    */
}
