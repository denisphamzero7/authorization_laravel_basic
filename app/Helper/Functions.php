<?php
use App\Models\Groups;
use App\Models\Doctors;
function isUppercase($value,$message,$fail){
    if($value!=mb_strtoupper($value,'UFT-8')){
        $fail($message);
    }
}

function getAllGroups(){
  // Khởi tạo đối tượng Groups mới rồi mới gọi hàm getAll
    $groups = new Groups();
    return $groups->getAll();
}
function isDoctorActive($email){
  $count = Doctors::where('email',$email)->where('is_active',1)->count();
  if ($count>0){
    return true;
  }
  return false;
}
