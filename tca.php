<?php
//Text Compression Algorithm (TCA)
//18.01.2015
//Author : Mert Gonul
//Github : https://github.com/mertgonul

class TCA{
   
   //the alphabet
   protected  $l;
   
   // the file where the dictionary array wiill be kept
   protected $filename; 

   /*
    * @param string $filename
    *
    */
  function __construct($filename = 'kdb.php'){
   $this->filename = $filename;  
    // TCA Alphabet
    // you can add more items to alphabet.                                                                                                                                           
   $this->l = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','W','X','Y','Z','`','-','=','[',']','©','~', ',' ,'.', '/', '!','@','#','$','%','^','&','*','(',')','_','+','{','}',':','?','>','<',';');  
  
  }

  /*
   * Compute the 2 letters alphabet and return it as an array 
   * @return array 
   *     
   */
  public function getLetters(){
      $i=0;
      $letters = array();
      foreach($this->l as $k=>$l1){
           
          foreach($this->l as $k2=>$l2){
            $lit = $l1.$l2;
            $letters[$i++]=$lit;
            
            
          }
      }

      return  $letters;
  }  
  /**
   * Based on a 2 letters alphabet decode the text  
   * @param string text
   * @return string text   
   * 
   *      
   *     */
  public function decryptForWeb($txt){
  
       

    $txt = $this->decrypt($txt); 
    return $txt;
  }
  /**
   * Based on a 2 letters alphabet decode the text  
   * @param string text
   * @return string text   
   * 
   *      
   *     */
  public function decrypt($text){
             

      // include the existent array to check if an item exist or not
      include($this->filename);
      // count how many items a dictonary have
      $count = strlen($text);
      $translation = '';
      for($i=0;$i<$count; $i+=2){

          $letter = mb_substr($text,$i,2,'UTF-8');

          if(isset($flst_dictionary[$letter])) {
          $lt = stripslashes($flst_dictionary[$letter]);
          if($lt == '.' || $lt == ',' || $lt == '!' || $lt == '?' || $lt == ':' || $lt == ';'){
            $translation = substr($translation,0, strlen($translation)-1);
          } 
          $translation .= $lt.' ';

          }else{
            $translation .= $letter.' ';
          }  

      }
                  $translation = substr($translation,0, strlen($translation)-1);
      return $translation;
  }

  public function cryptForWeb($txt) {    
  $txt = $this->crypt($txt); 


    return $txt;
  }
  /**
   * Encode a text
   * @param string $txt
   * @return string      
   *     **/
  public function crypt($txt){
  
        $txt = preg_replace("/\./",' .',$txt);
  $txt = trim(preg_replace('/[\r\n]+/', ' ', $txt));
  $txt = explode(' ',$txt);

  $cryptTxt = '';

    foreach($txt as $k=>$v){
          $cryptTxt .= $this->getChunkCode($v);
    }  
      return $cryptTxt;
  }
  
  /**
   * @param string $t
   * @return string   
   *     */
  public function getChunkCode($t){
  
   // remove new lines and spaces
    $t = trim(preg_replace('/\s\s+/', ' ', $t)); 
    
    if(!file_exists($this->filename)){
      
      $text = "<?php \n/* TCA Algorithm Keyword Database */ 
\$flst_dictionary = array(); \n";  
      
      file_put_contents($this->filename, $text);
    }
      include($this->filename);
      $content = file_get_contents($this->filename);
      $count = count($flst_dictionary);
    // dictionary is limited to 9999 because of the dictionary size
    if($count > 7921 || strlen($t) ==2 || $t =='') return $t; // if the text have 2 letters then there is nothing to compress
    
      $allLeters = $this->getLetters();
     
    if($count > 0){

       foreach($flst_dictionary as $k=>$v){
 
                if($v === $t) return $k;
       }
      }
       
    
       $count++;
       $content .= "\$flst_dictionary['".$allLeters[$count]."'] ='".addslashes(trim(htmlentities($t)))."' ;\n";
        
        file_put_contents($this->filename, $content);       
          return $allLeters[$count]; 
       
      
  }
}




?>