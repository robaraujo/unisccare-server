<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Auth;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{

	public function staff() {
		return Auth::guard('staff')->user();
	}

	/**
	 * Return if of master staff
	 */
	public function staffId() {
		$staff = $this->staff();
		return ($staff->staff_admin) ? $staff->staff_admin : $staff->id;
	}

}
