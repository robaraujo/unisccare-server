<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Staff\Staff;
use App\Models\Staff\User;
use App\Models\Staff\AutomatedMsg;
use App\Models\Staff\Msg;

class CronController extends Controller
{
	private $output;

	public function __construct()
    {
		$this->output = new \Symfony\Component\Console\Output\ConsoleOutput();
	}

    public function automatedMgs()
    {   
    	// iterate through all staffs
		foreach(Staff::all() as $staff) {

			// iterate through all automated staffs msgs
			foreach(AutomatedMsg::where('staff_id', $staff->id)->get() as $msg) {

				// get users that match with the message date
				$date = date('Y-m-d', strtotime("-{$msg->period_number} {$msg->period_type}"));
				$users = User::where('dt_operation', $date)->get();
					
				// iterate users
				foreach ($users as $user) {
					
					if ($msg->msg_user) {
						Msg::create([
							'user_id'	=> $user->id,
							'staff_id'	=> $staff->id,
							'from'		=> 'staff',
							'content'	=> $msg->msg_user,
							'automatic'	=> true,
						]);	
					} 

					if ($msg->msg_staff) {
						Msg::create([
							'user_id'	=> $user->id,
							'staff_id'	=> $staff->id,
							'from'		=> 'user',
							'content'	=> $this->replaceStringWithArray($msg->msg_staff, $user->toArray()),
							'automatic'	=> true,
						]);	
					}

					$this->show("Send message #{$msg->id} to user #{$user->id}", 'info');
				}
				
			}
		}
    }

    private function replaceStringWithArray($string, $data) {
    	return preg_replace_callback('/\{\$(.*?)\}/', function ($preg) use ($data) { return isset($data[$preg[1]]) ? $data[$preg[1]] : $preg[0]; }, $string);
    }

    public function show($msg, $type = 'info') {
    	$this->output->writeln("<{$type}>{$msg}</{$type}>");
    }
}
