<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 面談予定用モデルクラス
 */
class Meeting extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    /**
     * 「現在の日付より前」かつ、「現在の時刻より終了時間が前」の情報を削除
     */
    public function formerMeetingsDelete($nowDate, $nowTime)
    {
        Meeting::where('date', '<=', $nowDate)->where('ending_time', '<=', $nowTime)->delete();
    }
    
    /**
     * 本日の面談情報を取得
     */
    public function getTodayMeetings($mentorName)
    {
        $nowDate = date('Y-m-d');
        $todayMeetings = Meeting::where('date', '=', $nowDate)->where('mentor_name', '=', $mentorName)->orderBy('beginning_time')->get();
        return $todayMeetings;
    }
}
