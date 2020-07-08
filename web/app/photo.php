<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class photo extends Model
{
    //プライマリキーの型
    protected $keyType = "string";

    // IDの桁数
    const ID_LENGTH = 12;

    public function __construct(array $attributes =[])
    {
        // このModelのオブジェクトにコンストラクタでセットする
        parent::__construct($attributes);
        // オブジェクトのarrにセットされているはずのarrayをidを基準に取得する
        if(! Arr::get($this->attributes,"id")){
            // idをセットする
            $this->setId();
        }
    }

    /**
     *ランダムなID値をid属性に代入
     */ 
    private function setId(){
        $this->attributes["id"] = $this->getRandomId();
        
        echo $this->attributes["id"];
        exit;
    }
    
    /**
     * ランダムなID値を生成する
     */
    private function getRandomID()
    {
        $characters = array_merge(
        range(0, 9), range('a', 'z'),
        range('A', 'Z'), ['-', '_']
        );
        // 文字数を取得
        $length = count($characters);
        $id = "";

        for ($i = 0; $i < self::ID_LENGTH; $i++){
            $id .=$characters[random_init(0,$length -1)];
        }
        return $id;

    }
}
