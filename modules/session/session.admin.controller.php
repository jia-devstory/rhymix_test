<?php
/* Copyright (C) NAVER <http://www.navercorp.com> */
/**
 * @class  sessionAdminController
 * @author NAVER (developers@xpressengine.com)
 * @brief The admin controller class of the session module
 */
class SessionAdminController extends Session
{
	/**
	 * @brief Initialization
	 */
	function init()
	{
	}

	/**
	 * @brief The action to clean up the Derby session
	 */
	function procSessionAdminClear()
	{
		$oSessionController = getController('session');
		$oSessionController->gc(0);

		$this->add('result',lang('session_cleared'));
	}
}
/* End of file session.admin.controller.php */
/* Location: ./modules/session/session.admin.controller.php */
