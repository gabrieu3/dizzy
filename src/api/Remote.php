<?php
class Remote{


  function parse_the_result($requestURL){
  		$json = $this->fetchJSON($requestURL);
      echo $json;
  		// We'll usually have several "lists" returned in the JSON. Combine all these into one array.
  		if(empty($json->data->results)){
  			// IMDb doesn't return a proper error response in the event of 0 results being returned
  			// so set our own failure message.
  			$error->message = "No results found.";
  			$matches = $this->errorResponse($error, true);
  		}
  		else{
  			$results = $json->data->results;
  			$matches = array();

  			if($this->summary){
  				//$matches = $this->summarise_titles($results, intval($year));
          echo 'aqui';
  			}
  			else{
  				for($i=0; $i<count($results); $i++){
            echo $i;
  					$matches = array_merge($matches, $results[$i]->list);
  				}
  			}
  		}

  		return $matches;
  	}



  function fetchJSON($apiUrl){
  		$ch = curl_init($apiUrl);
  		$headers[] = 'Connection: Keep-Alive';
  		$headers[] = 'Content-type: text/plain;charset=UTF-8';
  		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  		curl_setopt($ch, CURLOPT_HEADER, 0);
  		curl_setopt($ch, CURLOPT_TIMEOUT, 0);
  		curl_setopt($ch, CURLOPT_ENCODING , 'deflate');
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  		curl_setopt($ch, CURLOPT_VERBOSE, 1);
  		$json = curl_exec($ch);
  		$curl_errno = curl_errno($ch);
  		$curl_error = curl_error($ch);
  		curl_close($ch);

  		// Errors?
  		if ($curl_errno > 0){
  			$data->error->message = 'cURL Error '.$curl_errno.': '.$curl_error;
  		}
  		else{
  			// Decode the JSON response
        libxml_use_internal_errors(true);
      }
  		return $json;
  	}

    function element_to_obj($element) {
        $obj = array( "tag" => $element->tagName );
        foreach ($element->attributes as $attribute) {
            $obj[$attribute->name] = $attribute->value;
        }
        foreach ($element->childNodes as $subElement) {
            if ($subElement->nodeType == XML_TEXT_NODE) {
                $obj["html"] = $subElement->wholeText;
            }
            else {
                $obj["children"][] = $this->element_to_obj($subElement);
            }
        }
        return $obj;
    }

    function html_to_obj($html) {
        $dom = new DOMDocument();
        $html = mb_convert_encoding($html, 'html-entities', mb_detect_encoding($html));
        $dom->loadHTML($html);
        $node = $dom->getElementsByTagName('div')->item(11);
        //$outerHTML = $node->ownerDocument->saveHTML($node);
        return $this->element_to_obj($node);
    }



}
