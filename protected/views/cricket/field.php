<?PHP


if($this->innings)
{
	if($this->innings==1)
	{
	?>

    <form method="post" id="pitch" action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/cricket/bat">
    <input type="hidden" name="hidden" value="<?PHP echo $this->ball; ?>" />
    <input type="hidden" name="score" value="<?PHP echo $this->score; ?>" />
    <input type="hidden" name="wkt" value="<?PHP echo $this->wkt; ?>" />
    <input type="hidden" name="mood" value="<?PHP echo $this->mood; ?>" />
    <input type="hidden" name="target" value="<?PHP echo $this->target; ?>" />
    <select name="text" id="text" style="display:none;">
    <option value="0">0</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="6">6</option>
    </select>
    <button class="score" onclick="return clicker(0);">0</button>
    <button class="score" onclick="return clicker(1);">1</button>
    <button class="score" onclick="return clicker(2);">2</button>
    <button class="score" onclick="return clicker(3);">3</button>
    <button class="score" onclick="return clicker(4);">4</button>
    <button class="score" onclick="return clicker(6);">6</button>
    <input type="submit" name="submit" style="display:none;" />
    </form>
    
    
    
    
    <br />


<?PHP
	}
}
?>

<div class='scorecard'><?PHP echo $this->score."/".$this->wkt; ?></div>  <div class='overcard'><?PHP echo " made in ".(int)($this->ball/6).".".($this->ball%6)." overs";

if($this->get_needed() > 0)
{
	echo "<br />
	Still need ".$this->get_needed()." from ".$this->get_balls_rem()." balls";
}

?>

</div>


<?PHP
if($this->alert)
{
	echo "<div class='alertcard'>".$this->alert."</div>";
}
?>


<div class='board'> 
<?PHP
echo "TARGET : ".$this->target;
?>
</div>