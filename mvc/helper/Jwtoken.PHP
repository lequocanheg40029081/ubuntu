<?php 

class Jwtoken{

    public $key = '';
    function CreateToken($array){
        $times = json_encode(['type' =>'jwt','time' => $array['time']]);
        $Base64UrlTime = str_replace(['+','/','='],['-','_',''],base64_encode($times));
        $this->key = $array['keys'];
        $info = json_encode(['id' => $array['info']['id'],'username' => $array['info']['username']]);
        $Base64Urlinfo = str_replace(['+','/','='],['-','_',''],base64_encode($info));
        $hash = hash_hmac('sha256',$Base64UrlTime.'.'.$Base64Urlinfo,$this->key,false);
        $jwt = $Base64UrlTime.'.'.$Base64Urlinfo.'.'.$hash;
        return $jwt;
    }
    function decodeToken(String $token, $keys) {
        $array = explode('.', $token);
    
        // Kiểm tra xem mảng có ít nhất ba phần tử hay không
        if (count($array) >= 3) {
            $times = $array[0];
            $userID = $array[1];
            $hash = $array[2];
    
            if (hash_equals(hash_hmac('sha256', $times . '.' . $userID, $keys, false), $hash)) {
                $decodeBase64Time = base64_decode($times);
                $decodeJS = json_decode($decodeBase64Time, true);
    
                if (isset($decodeJS['type']) && isset($decodeJS['time']) && $decodeJS['type'] == 'jwt' && $decodeJS['time'] >= time()) {
                    $id = base64_decode($userID);
                    return json_decode($id, true);
                } else {
                    return 0;
                }
            }
        }
    
        return 0; // Trả về 0 nếu có lỗi hoặc token không hợp lệ
    }
    
       }
    
