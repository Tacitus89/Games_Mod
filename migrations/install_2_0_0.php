<?php

/**
*
* @package GamesMod
* @copyright (c) 2015
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace tacitus89\gamesmod\migrations;

class install_2_0_0 extends \phpbb\db\migration\migration
{
	var $games_version = '2.0.0';
	
	public function effectively_installed()
	{
		return isset($this->config['games_version']) && version_compare($this->config['games_version'], $this->games_version, '>=');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\dev');
	}

	public function update_data()
	{
		return array(
			// Set the current version
			array('config.add', array('games_version', $this->games_version)),
			// All config
			array('config.add', array('games_active', 1)),
			array('config.add', array('game_small_img_width', 0)),
			array('config.add', array('game_small_img_ht', 0)),
			array('config.add', array('game_display_topic', 0)),
			array('config.add', array('games_description', 0)),
			array('config.add', array('game_topic_sep', 0)),
			array('config.add', array('game_recent', 0)),
			array('config.add', array('game_popular', 0)),
			array('config.add', array('game_play', 0)),
			array('config.add', array('game_play_allow', 0)),
			array('config.add', array('game_share_allow', 0)),
			array('config.add', array('game_play_index', 0)),
			array('config.add', array('game_recent_index', 0)),
			array('config.add', array('game_popular_index', 0)),
			array('config.add', array('games_pagination', 15)),
			array('config.add', array('game_recent_portal', 0)),
			array('config.add', array('game_popular_portal', 0)),
			array('config.add', array('game_play_portal', 0)),
			array('config.add', array('game_portal_thumb_width', 0)),
			array('config.add', array('game_portal_thumb_height', 0)),
			array('config.add', array('game_recent_side_portal', 0)),
			array('config.add', array('game_popular_side_portal', 0)),
			array('config.add', array('game_play_side_portal', 0)),
			array('config.add', array('game_stats_portal', 0)),
			array('config.add', array('game_topic_limit', 0)),
			array('config.add', array('game_index_ext_stats', 0)),
			
			//TODO: Module einbauen
			//Set ACP-Module
			/*
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ACP_GAMES_INDEX')),
			array('module.add', array(
				'acp', 'ACP_GAMES_INDEX', array(
					'module_basename'	=> '\tacitus89\gamesmod\acp\gamesmod_module',
					'modes'				=> array('config', 'management'),
				),
			)),
			//Set UCP-Module
			array('module.add', array('ucp', '', 'UCP_GAMES_INDEX')),
			array('module.add', array(
				'ucp', 'UCP_GAMES_INDEX', array(
					'module_basename'	=> '\tacitus89\gamesmod\ucp\gamesmod_module',
					'modes'				=> array('index', 'add'),
				),
			)),
			*/
			
			//TODO: Testen!!!
			// Add permission
			array('permission.add', array('u_masspm_game', true)),
			// Set permissions
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'u_masspm_game')),
		);
	}
	
	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'games' => array(
					'COLUMNS'			=> array(
						'id'			=> array('UINT', NULL, 'auto_increment'),
						'name'			=> array('VCHAR:100', ''),
						'description'	=> array('VCHAR:255', ''),
						'image'			=> array('VCHAR:100', 0),
						'parent'		=> array('UINT:5', 0),
					),
					'PRIMARY_KEY'	=> 'id',
				),
				$this->table_prefix . 'games_awarded' => array(
					'COLUMNS'		=> array(
						'id'		=> array('UINT', NULL, 'auto_increment'),
						'game_id'	=> array('UINT:10', 0),
						'user_id'	=> array('UINT:10', 0),
						'play'		=> array('BOOL', '0'),
						'share'		=> array('BOOL', '0'),
						'share_id'	=> array('UINT:8', '0'),
					),
					'PRIMARY_KEY'	=> 'id',	
				),
				$this->table_prefix . 'games_cats' => array(
					'COLUMNS'		=> array(
						'id'		=> array('UINT', NULL, 'auto_increment'),
						'name'		=> array('VCHAR:30', ''),
						'dir'		=> array('VCHAR:30', ''),
						'order_id'	=> array('UINT', 0),
					),
					'PRIMARY_KEY'	=> 'id',
					'KEYS'			=> array(
						'order_id'		=> array('INDEX', 'order_id'),
					)
				),
			),
			
			'add_columns'	=> array(
				$this->table_prefix . 'users'		=> array(
					'game_view'			=> array('BOOL', '1'),
				),
				$this->table_prefix . 'posts'		=> array(
					'enable_games'		=> array('BOOL', '1'),
				),
			),
		);
	}
	
	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'games',
				$this->table_prefix . 'games_awarded',
				$this->table_prefix . 'games_cats',
			),
			'drop_columns'	=> array(
				$this->table_prefix . 'users' => array('game_view'),
				$this->table_prefix . 'posts' => array('enable_games'),
			),
		);
	}
}
