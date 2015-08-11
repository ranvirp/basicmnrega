<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
 $block_code=$faker->getRandomBlockCode();
 $district_code=$faker->getDistrictCode($block_code);
 $panchayat_array=$faker->getRandomPanchayat($block_code);
 $panchayat_code=$panchayat_array[0];
 $panchayat=$panchayat_array[1];
 $create_time=$faker->unixTime();
 
return [
    'name_hi' => $faker->firstName,
    'fname'=>$faker->firstName,
    'mobileno' => $faker->unique()->randomNumber(),
    'address' => $faker->address,
    'jobcardno' =>$faker->randomNumber() ,
    'complaint_type'=>'corruption',
     'complaint_subtype'=>'prcorr',
     'description'=>$faker->sentence(4),
     'district_code'=>$district_code,
     'block_code'=>$block_code,
     'panchayat_code'=>$panchayat_code,
     'panchayat'=>$panchayat,
     'status'=>3,
     'attachments'=>'',
     'manualno'=>$faker->randomNumber(5),
     'source'=>$faker->getRandomSource(),
     'gender'=>$faker->getRandomGender(),
     'flag'=>0,
     
     
     'created_by'=>1,
   'updated_by'=>1,
   'created_at'=>$create_time,
   'updated_at'=>$create_time,
   'flowtype'=>0,
];
?>