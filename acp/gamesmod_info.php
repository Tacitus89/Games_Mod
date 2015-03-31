<?php
/**
*
* @package GamesMod
* @copyright (c) 2015
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace phpbb\gamesmod\acp;

class gamesmod_info
{
	function module()
	{
		return array(
			'filename'	=> '\tacitus89\gamesmod\acp\gamesmod_module',
			'title'		=> 'ACP_GAMES_INDEX',
			'modes'		=> array(
				'config'	=> array('title' => 'ACP_GAMES_SETTINGS', 	'auth' => 'ext_tacitus89/gamesmod && acl_a_board', 'cat' => array('ACP_GAMES_INDEX')),
				'management'=> array('title' => 'ACP_GAMES_TITLE', 		'auth' => 'ext_tacitus89/gamesmod && acl_a_board', 'cat' => array('ACP_GAMES_INDEX')),
			),
		);
	}
}
