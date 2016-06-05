<?php
  include("zklib/zklib.php");

  Class zklib_interface{

    public function process()
    {
      $zk = new ZKLib("192.168.1.201", 4370);

      $zk_records = $zk->connect();
      $records = array();

      if($zk_records)
      {
        $attendance = $zk->getAttendance();
        $zk->disconnect();

        while(list($idx, $attendancedata) = each($attendance))
        {
          if ( $attendancedata[2] == 1 )
            $status = 'C/Out';
          else
            $status = 'C/In';
          $ac_no  = $attendancedata[1]; // ac_no
          $log_time = date("Y-m-d", strtotime($attendancedata[3])).' '.date("H:i:s", strtotime($attendancedata[3])); // log_time
          $log_type = $status; // log_type

          $records[] = array(
            'ac_no' =>  $ac_no,
            'log_time' => $log_time,
            'log_type' => $log_type,
          );
    		}
    	}

      $return_data = $this->hext($records);
      
      return $return_data;
    }


    private function hext($records)
    {
      $hexarr = array();
      foreach($records as $record_key => $record)
      {
        foreach($record as $rec_key => $rec)
        {
          if($rec_key == 'ac_no')
            $hexarr[$record_key][$rec_key] = $this->clean_data($this->custom_hextobin($rec));
          else
            $hexarr[$record_key][$rec_key] = $rec;
        }
      }
      return $hexarr;
    }

    private function clean_data($value)
    {
      $data = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', trim($value));

      return $data;
    }

    /**
     * Taken from SO.
     * decrypts hex data to human readable text, particularly ac_no data for this one and only usage
     * @param  string $hexstr hex string
     * @return string         decrypted string
     */
    private function custom_hextobin($hexstr)
    {
        $n = strlen($hexstr);
        $sbin="";
        $i=0;
        while($i<$n)
        {
            $a =substr($hexstr,$i,2);
            $c = pack("H*",$a);
            if ($i==0){$sbin=$c;}
            else {$sbin.=$c;}
            $i+=2;
        }
        return $sbin;
    }
  }
?>
