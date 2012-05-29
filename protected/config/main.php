<?php

return array(
	'name'=>'Cricket Game',
	'defaultController'=>'cricket',
	'components'=>array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'game/guess/<g:\w>'=>'game/guess',
			),
		),
	),
);