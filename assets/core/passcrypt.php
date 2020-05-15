<?php



class passcrypt{

	public $rchars = 'zxcvbnmasdfghjklqwertyuiop1234567890ZXCVBNMASDFGHJKLQWERTYUIOP~!@#$%^&*()_+[]\{}|,./?/';

    private function pgen($pwd,$hint){

        $c = str_split(preg_replace($this->preg($hint),'',$this->rchars));

        $cl = count($c)-1;
        $p = [];
        $l = strlen($pwd) * 3 + rand(0,50);


		for($i = 0; $i < $l; $i++){ $p[] = $c[rand(0,$cl)]; }

		return implode('',$p);


	}

    private function preg($str){
		$str = array_unique(str_split($str));
		return '/['.implode( '', $this->map( $str , function($v){ return preg_quote($v,'/'); } ) ).']/';
	}

    private function map(&$item,$fn=''){
        if(is_object($item) || is_array($item)){
            foreach($item as $k => &$v){
                $this->map($v,$fn);
            }
        }else{
            $item = call_user_func($fn,$item);
        }
        return $item;
    }

    public function encrypt($password,$hint){

		if( $password == $hint )
			throw new \Exception('String cannot be the same as your hint password.');

		$password = (string)$password;
		$hint = (string)$hint;
		$k  = '';
		$x  = 0;
		$t  = 0;
		$s  = array();
		$d  = false;
		$c  = str_split($this->pgen($password,$hint));
		$ol = strlen($hint);
		$pl = strlen($password);

		$m = floor( count($c)/3 );
		$nx = array();

		for($i = 0; $i < $m; $i++){
			$nx[$i] = (($i+1)*3);
		}

		shuffle($nx);

		$f = array_slice( $nx, 0, $pl );

		$k = array();
		for($i = 0; $i < $pl; $i++){
			if(!isset($hint[$x])){
				$x = 0;
			}
		if(!isset($k[$hint[$x]]))
			$k[$hint[$x]] = array();

			$k[$hint[$x]][] = $f[$i];


			$x++;
		}

        foreach($k as $i => $v){
			rsort($k[$i]);
		}

		$x = 0;
		$hp = 0;
		for($i = 0; $i < $pl; $i++){
			if( $x >= $ol ){
				$x = 0;
			}
            $hp = array_shift($k[$hint[$x]]);
            $c[$hp] = $hint[$x];
            $c[$hp+1] = $password[$i];

            $x++;
		}

		return str_replace('<','&lt;',implode($c,'').'passcrypt:'.($pl+$ol).':');

	}

	public function decrypt($encrypted,$hint){

		$encrypted = str_replace(array('&lt;'),'<',$encrypted);
		preg_match('/(.*?)passcrypt:(\d+):$/',$encrypted,$q);

		$hint = (string)$hint;
		$ol = strlen($hint);

		$pl = $q[2] - $ol;
		$p = $q[1];
		$x = 0;
		$hg = $this->preg($hint);
		$c = str_split($q[1]);
		$e = array();
		$k = array();
		$nl = array();


		preg_match_all( $hg, $p, $xout, PREG_OFFSET_CAPTURE );

		foreach($xout[0] as $key => $val){

			$x0 = $val[0];
			$index = $val[1];

			if( !isset($nl[$index-1]) ){
				$nl[$index] = 1;
				if( !isset($k[$x0]) )
					$k[$x0] = array();
					$k[$x0][] = $index;

			}

		}
		foreach($k as $i => $v){
			rsort($k[$i]);
		}


		$x = 0;
		for($i = 0; $i < $pl; $i++){
			if($x >= $ol){
				$x = 0;
			}
			if(isset($k[$hint[$x]])){
				$e[] = $c[array_shift($k[$hint[$x]])+1];
			}
			$x++;
		}


		return implode('',$e);


	}


}




$passcrypt = new passcrypt();

$str = 'my-string';
$pwd = 'my-password';

$newstr = $passcrypt->encrypt($str, $pwd);
echo $newstr.'<br/>';

echo $passcrypt->decrypt($newstr, $pwd) == $str;
echo '</br></br>';

$str = 'my-string';
$pwd = '`12347890-=';

$newstr = $passcrypt->encrypt($str, $pwd);
echo $newstr.'<br/>';

echo $passcrypt->decrypt($newstr, $pwd) == $str;
echo '</br></br>';

$str = 'my-string';
$pwd = '~!@#$&*()_+%';

$newstr = $passcrypt->encrypt($str, $pwd);
echo $newstr.'<br/>';

echo $passcrypt->decrypt($newstr, $pwd) == $str;
echo '</br></br>';

$str = 'my-string';
$pwd = '[]\{}|-=_+;\':"';

$newstr = $passcrypt->encrypt($str, $pwd);
echo $newstr.'<br/>';

echo $passcrypt->decrypt($newstr, $pwd) == $str;
echo '</br></br>';

$str = 'my-string';
$pwd = ',./<>?';

$newstr = $passcrypt->encrypt($str, $pwd);
echo $newstr.'<br/>';

echo $passcrypt->decrypt($newstr, $pwd) == $str;
