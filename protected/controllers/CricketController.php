<?php
/**
 * GameController class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */


/**
 * GameController implements the {@link http://en.wikipedia.org/wiki/Hangman_(game) Hangman game}.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CController.php 131 2008-11-02 01:32:57Z qiang.xue $
 * @package demos.hangman
 * @since 1.0
 */
class CricketController extends CController
{
	/**
	 * @var string sets the default action to be 'play'
	 */
	public $defaultAction='play';
	private $total_balls = 120;
	private $total_wkts = 10;
	public $innings = 1;
	public $hit = 0;
	public $delivery = 0;
	public $wkt = 0;
	public $shot = 0;
	public $mood = "N";
	public $character = array("D","T","L","H","N","R");
	public $ball = 0;
	public $score = 0;
	public $alert = "";
	public $target = "";
	public $needed = 0;
	public $balls_rem = 0;

	/**
	 * The 'play' action.
	 * In this action, users are asked to choose a difficulty level
	 * of the game.
	 */
	public function actionPlay()
	{
		$_POST['hidden']=0;
		$_POST['score']=0;
		$_POST['wkt']=0;
		$_POST['text']=0;
		$_POST['mood']='N';
		$target = rand(180,280);
		$this->initialize($_POST['hidden'],$_POST['text'],$_POST['wkt'],$_POST['score'],$_POST['mood'],$target);
		$this->render('field');
	}

	
	 
	public function actionBat()
	{
		if(isset($_POST['hidden']))
		{
			$this->initialize($_POST['hidden'],$_POST['text'],$_POST['wkt'],$_POST['score'],$_POST['mood'],$_POST['target']);
			$this->set_mood();
			$this->get_delivery();
			$this->check_wicket();
			$this->update_score();
			$this->render('field');
		}
		else
		{
			$this->redirect(Yii::app()->request->baseUrl); 
		}
	}
	

	public function randWithout($from, $to, array $exceptions)
	{
    	sort($exceptions);
    	$number = mt_rand($from, $to - count($exceptions)); 
    	foreach ($exceptions as $exception) 
		{
        	if ($number >= $exception) 
			{
            	$number++; 
        	} 
			else 
			{
            	break;
        	}
    	}
   	 	return $number;
	}
	
	public function get_delivery()
	{
	
		switch($this->mood)
		{
			case "D":
					$this->delivery = $this->randWithout(1,6,array(5));
					if($this->hit == $this->delivery)
					{
						$this->hit = -1;
					}
					break;
			case "T":
					$this->delivery = $this->randWithout(4,6,array(5));
					if($this->hit == $this->delivery)
					{
						$this->hit = -1;
					}
					break;			
			case "L":
					$this->delivery = $this->randWithout(3,6,array(5));
					if($this->hit == $this->delivery)
						$this->hit = -1;	
					break;		
			case "H":
					$this->delivery = $this->randWithout(2,6,array(5));
						if($this->hit == $this->delivery)
						$this->hit = -1;
					break;	
			case "N":
					$this->delivery = $this->randWithout(2,6,array(5));
					if($this->hit == $this->delivery)
						$this->hit = -1;
					break;	
			case "R":
					$this->delivery = mt_rand(0,4);
					if($this->hit == $this->delivery)
						$this->hit = -1;
					break;	
		}		
		
	}
	
	public function set_alert($for)
	{
		switch($for)
		{
			case 'W': $this->alert = "WICKET"; break;
			case '4': $this->alert = "FOUR"; break;
			case '6': $this->alert = "SIX"; break;
			case '0': $this->alert = "WON by ".($this->total_wkts-$this->wkt)." Wickets"; break;
			case '1': $this->alert = "LOST by ".$this->get_needed()." Runs"; break;
			case '2': $this->alert = "MATCH DRAWN"; break;
		}
	}
	
	public function get_needed()
	{
		$this->needed = $this->target-$this->score;
		
		if($this->needed >= 0)
		return $this->needed;
		else
		return -1;
		
	}
	
	public function get_balls_rem()
	{
		$this->balls_rem = $this->total_balls-$this->ball;
		
		if($this->balls_rem > 0)
		return $this->balls_rem;
		else
		return 0;
		
	}
	
	
	public function set_mood()
	{
		if(($this->ball%6)==0)
		{
			$index = mt_rand(0, 5);
			$this->mood = $this->character[$index];
		}
	}
	
	
	public function check_wicket()
	{
		if($this->hit == -1)
		{
			$this->hit = 0;
			$this->wkt++;			
			$this->set_alert('W');
		}
	}
	
	public function set_target()
	{
		if($this->hit == -1)
		{
			$this->hit = 0;
			$this->wkt++;			
			$this->set_alert('W');
		}
	}
	
	public function update_score()
	{
		if($this->wkt<$this->total_wkts)
		{
			++$this->ball;
			if($this->get_balls_rem())
			{
				$this->score = $this->hit + $this->score;
				
				
				switch($this->hit)
				{
					case 6:$this->set_alert('6');break;
					
					case 4:$this->set_alert('4');break;					
					 
				}
								
				if($this->get_needed() == -1){$this->innings = 0;$this->set_alert('0');  }
				
			}
			else
			{
				$this->score = $this->hit + $this->score;
				$this->innings = 0;
				
				if($this->get_needed() > 0){$this->set_alert('1');  }elseif($this->get_needed() == 0){$this->set_alert('2');} else{$this->set_alert('0');}
				
				
			}
		}
		else
		{
			$this->innings = 0;
			
			if($this->get_needed() > 0){$this->set_alert('1');  }elseif($this->get_needed() == 0){$this->set_alert('2');} else{$this->set_alert('0');}
		}
	}
	
	public function initialize($ball,$hit,$wkt,$score,$mood,$target) 
    { 
        $this->ball = $ball;
		$this->hit = $hit;
		$this->wkt = $wkt;
		$this->score = $score;
		$this->mood = $mood;
		$this->target = $target;
    }
}