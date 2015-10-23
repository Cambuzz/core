<?php

namespace App\Http\Controllers;
use DB;
use View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{
	public function track(Request $request)
	{
		$teacher=DB::table('faculty_final')->whereName($request['facultyname'])->first();
    //return $teacher->cabin;
	if($teacher)
	{
    $outarr = $teacher->period;
    $out = explode(" ", $outarr);
    $matrix = array();
    for ($rowIndx=0; $rowIndx<5; $rowIndx++){
        $matrix[] = array();
        for($colIndx=0; $colIndx<13; $colIndx++){
            $matrix[$rowIndx][$colIndx]=0;
        }
    }
    $c = 0;
    for ($i=0; $i < 5; $i++) 
    { 
        for ($j=0; $j < 13; $j++) 
        { 
            $matrix[$i][$j] = $out[$c++];                                    
        }                
    }
    date_default_timezone_set("Asia/Kolkata");
    $day = date("l");
    $hour = date("H");
    $minute = date("i");
    $matrix = array();
    for ($rowIndx=0; $rowIndx<5; $rowIndx++){
        $matrix[] = array();
        for($colIndx=0; $colIndx<13; $colIndx++){
            $matrix[$rowIndx][$colIndx]=0;
        }
    }
    $c = 0;
    for ($i=0; $i < 5; $i++) 
    { 
    	for ($j=0; $j < 13; $j++) 
    	{ 
    		$matrix[$i][$j] = $out[$c++];   
                                         //echo $matrix[$i][$j];
                                         //echo "<br>";
        }                
    }
    $timarr = array();
    for ($rowIndx=0; $rowIndx<13; $rowIndx++)
    {
        $timarr[] = array();
        for($colIndx=0; $colIndx<2; $colIndx++)
        {
            $timarr[$rowIndx][$colIndx]=0;
        }
    }
                                   $timarr[0][0]=8;
                                   $timarr[0][1]=50;
                                   $timarr[1][0]=9;
                                   $timarr[1][1]=45;
                                   $timarr[2][0]=10;
                                   $timarr[2][1]=40;
                                   $timarr[3][0]=11;
                                   $timarr[3][1]=35;
                                   $timarr[4][0]=12;
                                   $timarr[4][1]=30;
                                   $timarr[5][0]=13;
                                   $timarr[5][1]=20;
                                   $timarr[6][0]=14; 
                                   $timarr[6][1]=05;
                                   $timarr[7][0]=14;
                                   $timarr[7][1]=55;
                                   $timarr[8][0]=15;
                                   $timarr[8][1]=50;
                                   $timarr[9][0]=16;
                                   $timarr[9][1]=45;
                                   $timarr[10][0]=17;
                                   $timarr[10][1]=40;
                                   $timarr[11][0]=18;
                                   $timarr[11][1]=35;
                                   $timarr[12][0]=19;
                                   $timarr[12][1]=30;
                  

                                   $tim_disp=array("8:50","9:45","10:40","11:35","12:30","13:20","14:05","14:55","15:50","16:45","17:40","18:35","19:30");
                   


                                   $r=10;
                                   $day_disp=array("Monday's","Tuesday's","Wednesday's","Thursday's","Friday's");
                                   if ($day=="Monday") $r=0;
                                   elseif ($day=="Tuesday") $r=1;
                                   elseif ($day=="Wednesday") $r=2;
                                   elseif ($day=="Thursday") $r=3;
                                   elseif ($day=="Friday") $r=4;
                                   $start=0;
                                   $end=0;
                                   $itr=0;
                                   if($r>4)
                                   {
                                      $r=0;
                                      $itr=0;
                                   }
                                   elseif(($hour>=19 && $minute>=30)||($hour>=20))
                                   {
                                       $r++;
                                        //$itr=0;
                                   }
                                   elseif($hour>=8)
                                   {
                                       for($i=0;$i<13;$i++)
                                        {
                                            if($hour==$timarr[$i][0])
                                            {
                                                if($minute<=$timarr[$i][1])
                                                {
                                                   $itr=$i;
                                                }
                                                else $itr=$i+1;
                                                break;
                                            }
                                        }
                                   }
                                   $r=$r%5;
                                   $day= $day_disp[$r];
                                   $slots=array();
                                   for($i=$itr;$i<13;$i++)
                                   {
                                        if($matrix[$r][$i]==0)$start=$i;
                                        else continue;
                                        while($matrix[$r][$i]==0)
                                        {
                                             $end=$i;
                                             $i++;
                                             if($i==13)break;
                                        }
                                        if($start==0)
                                        {
                                            $slots[]="8:00-".$tim_disp[$end];
                                        }
                                        else
                                        {
                                             $slots[]=$tim_disp[$start-1]."-".$tim_disp[$end];
                                        }
                                        
                                   }
            //$teacher=array('name'=>$teacher->name,'cabin'=>$teacher->cabin,'day'=>$day,'slots'=>$slots);
    		return View::make('track')->with('teacher',array('name'=>$request['facultyname'],'cabin'=>$teacher->cabin,'day'=>$day,'slots'=>$slots));
    	}
    	else
    	{
    		return View::make('track')->with('teacher',array('name'=>$request['facultyname'],'cabin'=>Null,'day'=>Null,'slots'=>Null));
    	}
	}
}