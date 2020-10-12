<?php

/*
  Collapse Gibbs Sampling
  created: bambang subeno  
  
  A =  jumlah kata w yang masuk topik k 
  B =  jumlah kata pada topik ke-k 
  C = hitung jumlah kata pada dokumen ke-i dan topik ke-k  
  
*/

 class CollapsGibbs
 {
	private $alfa;
	private $beta;
	private $k_awal;
	private $Kawal;
	public $hasil_gibbs;
	
	public function __construct()
    {
        $this->CI =& get_instance();
    }
	
	public function setAlfa($alfa){
		$this->alfa=$alfa;
	}
	public function setBeta($beta){
		$this->beta=$beta;
	}
	public function setK_awal($k_awal){ // model 
		$this->k_awal=$k_awal;
	}
	public function setKawal($Kawal){ // start K topik
		$this->Kawal=$Kawal;
	}	
	
	public function process_gibbs($K,$process,$n_iterasi){ // number topik and number process gibbs	
		//echo "ok";
		
		//for ($l=$K;$l<$K+$process;$l++){
			$alfa = $this->alfa;
			$beta = $this->beta;
			$k_awal = $K;
			
			//$this->getArrayData($l);
			//$data = $this->arrayData;
			/*
			$sql = " SELECT a.id_doc, a.id_kata, a.kata, b.new_topik from tb_kata a 
				LEFT JOIN 
				(
				  SELECT id_doc, kata,  ROUND(rand()*".$K.") as new_topik from tb_kata GROUP BY id_doc, kata
				) b ON a.id_doc=b.id_doc and a.kata=b.kata ";					
			*/		
			$sql = " SELECT id_doc, id_kata, kata,  ROUND(rand()*".$K.") as new_topik from tb_kata";// limit 0,4";		
			$data = $this->CI->db->query($sql)->result_object();
			$idx=0;
			foreach($data as $rw){
				//Array jumlah kata pada dokumen ke-i dan topik ke-k
				$data_c[$rw->id_doc][$rw->new_topik]= isset($data_c[$rw->id_doc][$rw->new_topik]) ? 
												$data_c[$rw->id_doc][$rw->new_topik] + 1 : 1;
				//Array jumlah kata w yang masuk topik ke-k
				$data_a[$rw->kata][$rw->new_topik]= isset($data_a[$rw->kata][$rw->new_topik]) ? 
												  $data_a[$rw->kata][$rw->new_topik] + 1 : 1;
				//Array jumlah kata pada topik ke-k
				$jml[$rw->new_topik]['jml']= isset($jml[$rw->new_topik]['jml']) ? $jml[$rw->new_topik]['jml'] + 1 : 1;		
				
			}		
			
			
			$max_iterasi = $n_iterasi;
			for ($iterasi=1;$iterasi<=$max_iterasi;$iterasi++){				
			  $n=0; $data_topik=""; $sum[$iterasi]=0; 
			  
			  if ($max_iterasi>1) {				
				foreach($data as $r){
				   $sum[$iterasi]=$sum[$iterasi]+$r->new_topik;
				}				
				$this->CI->session->set_userdata('maxiterasi',$iterasi);
				
				$iterasi = $iterasi>1 ? ($sum[$iterasi] == $sum[$iterasi-1] ? $max_iterasi+2 : $iterasi ) : $iterasi;				
			  }		  			  
			  
			  if ($iterasi<=$max_iterasi ) {				
				
				//$idx=0;
				foreach ($data as $row){			
					$n++;
					//$top[$idx][$iterasi]='';
					//file_put_contents('datafile.dat', ($i/$jmldata)*100 );			
					for ($k=0;$k<=$k_awal;$k++){
						$token = $row->new_topik == $k ? 1 : 0;	
						if (isset($jml[$k]['jml'])){
							$jml_kata = $jml[$k]['jml']==0 ? 0 : $jml[$k]['jml']-$token;	
						}else{
							$jml_kata =0;
						}
						if (isset($data_a[$row->kata][$k])){
							$A = $data_a[$row->kata][$k]==0 ? 0 : $data_a[$row->kata][$k]-$token;	
						}else{
							$A =0;
						}				
						if (isset($data_c[$row->id_doc][$k])){
							$C = $data_c[$row->id_doc][$k]==0 ? 0 : $data_c[$row->id_doc][$k]-$token;	
						}else{
							$C =0;
						}				
						//---------------------------
						$pwz[$k] = ($A + $beta)/($jml_kata+$beta) * ($C+$alfa);
					}
					$pwz = array_keys($pwz, max($pwz));				
					//$top[$idx][$iterasi]=$top[$idx][$iterasi].' old '.$row->new_topik.' new '.$pwz[0];				

					// update topik pada token ke i
					$topik_old=$row->new_topik;			
					$topik_new = $pwz[0];					
					
					if ($topik_old!=$topik_new){
						// update array jumlah kata pada topik ke-k  ( B )
						if (isset($jml[$topik_new]['jml'])){ //jika ada
							if ($jml[$topik_new]['jml']>=0) $jml[$topik_new]['jml'] =$jml[$topik_new]['jml']+1;
						}else $jml[$topik_new]['jml'] = 1;
						
						if (isset($jml[$topik_old]['jml'])){ //jika ada
							if ($jml[$topik_old]['jml']>0) $jml[$topik_old]['jml'] =$jml[$topik_old]['jml']-1;
						}else $jml[$topik_old]['jml'] = 0;				
						
						//update array jumlah kata pada dokumen ke-i dan topik ke-k ( C )
						$i = $row->id_doc; $j = $topik_new;				
						if (isset($data_c[$i][$j])){ //jika ada
							if ($data_c[$i][$j]>=0)	$data_c[$i][$j] = $data_c[$i][$j]+1;
						}else $data_c[$i][$j] = 1;
						
						$i = $row->id_doc; $j = $topik_old;				
						if (isset($data_c[$i][$j])){ //jika ada
							if ($data_c[$i][$j]>0)	$data_c[$i][$j] = $data_c[$i][$j]-1;					
						}else	$data_c[$i][$j] = 0;				
						//update array jumlah kata w yang masuk topik k ( A )
						$i = $row->kata; $j = $topik_old;				
						if (isset($data_a[$i][$j])){ //jika ada
							if ($data_a[$i][$j]>0)	$data_a[$i][$j] = $data_a[$i][$j]-1;					
						}else	$data_a[$i][$j] = 0;
						
						$i = $row->kata; $j = $topik_new;				
						if (isset($data_a[$i][$j])){ //jika ada
							if ($data_a[$i][$j]>=0)	$data_a[$i][$j] = $data_a[$i][$j]+1;
						}else	$data_a[$i][$j] = 1;	
					}		
					$row->new_topik=$topik_new;
					// save ke file, tujuannya untuk execusi insert sekaligus
					//$data_topik = $data_topik.$row->id_doc.",".$row->id_kata.",".$pwz[0]." ";	
					//file_put_contents('logfile/'.$file, $data_topik,FILE_APPEND);		
						
					if ($k_awal==$this->Kawal){  
						
						$this->hasil_gibbs[$n]= array(
										'id_doc'=>$row->id_doc,
										'id_kata'=>$row->id_kata,
										'kata'=>$row->kata,
										'topik'.$k_awal=>$pwz[0]//$top[$idx] 
									);			
						
					}else{
						if (! isset($this->hasil_gibbs[1]['topik'.$this->Kawal])){
							$this->hasil_gibbs[$n]= array(
										'id_doc'=>$row->id_doc,
										'id_kata'=>$row->id_kata,
										'kata'=>$row->kata
									);
						}
						$this->hasil_gibbs[$n]['topik'.$k_awal]=$pwz[0];//$top[$idx];
					}
					
				
				//$this->model[$k_awal][$pwz[0]] = isset($this->model[$k_awal][$pwz[0]]) ? $this->model[$k_awal][$pwz[0]]+1 : 1 ;
				//$this->vocab[$row->kata][$k_awal][$pwz[0]] = 
				//isset($this->vocab[$row->kata][$k_awal][$pwz[0]]) ? $this->vocab[$row->kata][$k_awal][$pwz[0]]+1 : 1;
			
					
					//$idx++;				
				}//end foreach
			  }				
			} // end iterasi							
		//}		
	}
	
	
 }
 
?>